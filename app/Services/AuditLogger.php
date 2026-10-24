<?php

namespace App\Services;

use App\Enums\AuditAction;
use App\Models\AuditLog;
use App\Models\User;
use BackedEnum;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Throwable;
use UnitEnum;

class AuditLogger
{
    private static bool $writing = false;

    public static function model(string $event, mixed $model): void
    {
        if (! $model instanceof Model || $model instanceof AuditLog || self::shouldSkip()) {
            return;
        }

        $action = match ($event) {
            'created' => AuditAction::Created,
            'updated' => AuditAction::Updated,
            'deleted' => AuditAction::Deleted,
            'restored' => AuditAction::Restored,
            default => null,
        };

        if ($action === null) {
            return;
        }

        [$old, $new] = self::changes($action, $model);

        if ($action === AuditAction::Updated && $old === [] && $new === []) {
            return;
        }

        self::store(
            action: $action,
            user: auth()->user(),
            type: $model::class,
            id: $model->getKey(),
            label: self::label($model),
            old: $old,
            new: $new,
        );
    }

    public static function auth(AuditAction $action, mixed $user, array $context = []): void
    {
        if (self::shouldSkip()) {
            return;
        }

        self::store(
            action: $action,
            user: $user instanceof User ? $user : null,
            type: null,
            id: null,
            label: $user instanceof User ? self::label($user) : null,
            old: [],
            new: self::context($context),
        );
    }

    /**
     * @param  array<string, mixed>  $old
     * @param  array<string, mixed>  $new
     */
    private static function store(
        AuditAction $action,
        mixed $user,
        ?string $type,
        mixed $id,
        ?string $label,
        array $old,
        array $new,
    ): void {
        if (self::$writing) {
            return;
        }

        self::$writing = true;

        try {
            $request = request();

            AuditLog::query()->create([
                'user_id' => $user instanceof User ? $user->getKey() : null,
                'action' => $action,
                'auditable_type' => $type,
                'auditable_id' => is_numeric($id) ? (int) $id : null,
                'record_label' => $label,
                'old_values' => $old === [] ? null : $old,
                'new_values' => $new === [] ? null : $new,
                'ip_address' => $request?->ip(),
                'user_agent' => $request ? mb_substr((string) $request->userAgent(), 0, 1000) : null,
                'url' => $request ? mb_substr($request->fullUrl(), 0, 2048) : null,
            ]);
        } catch (Throwable $exception) {
            report($exception);
        } finally {
            self::$writing = false;
        }
    }

    /**
     * @return array{0: array<string, mixed>, 1: array<string, mixed>}
     */
    private static function changes(AuditAction $action, Model $model): array
    {
        if ($action === AuditAction::Updated) {
            $old = [];
            $new = [];

            foreach ($model->getChanges() as $key => $value) {
                if (self::ignored($key)) {
                    continue;
                }

                if (self::sensitive($key)) {
                    $old[$key] = 'hidden';
                    $new[$key] = 'changed';

                    continue;
                }

                $old[$key] = self::normalize($model->getOriginal($key));
                $new[$key] = self::normalize($value);
            }

            return [$old, $new];
        }

        $snapshot = [];

        foreach ($model->getAttributes() as $key => $value) {
            if (in_array($key, ['id', 'created_at', 'updated_at', 'deleted_at'], true) || self::ignored($key)) {
                continue;
            }

            if (self::sensitive($key)) {
                $snapshot[$key] = 'changed';

                continue;
            }

            $snapshot[$key] = self::normalize($value);
        }

        return $action === AuditAction::Deleted ? [$snapshot, []] : [[], $snapshot];
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>
     */
    private static function context(array $context): array
    {
        $clean = [];

        foreach ($context as $key => $value) {
            if (self::sensitive((string) $key) || $value === null || $value === '') {
                continue;
            }

            $clean[$key] = self::normalize($value);
        }

        return $clean;
    }

    private static function label(Model $model): ?string
    {
        if ($model instanceof User) {
            $name = trim($model->name.' '.$model->last_name);

            return mb_substr($name !== '' ? $name : (string) $model->username, 0, 255);
        }

        foreach (['title', 'name', 'username', 'slug'] as $key) {
            $value = $model->getAttribute($key);

            if (is_scalar($value) && trim((string) $value) !== '') {
                return mb_substr(trim((string) $value), 0, 255);
            }
        }

        $key = $model->getKey();

        return $key === null ? null : '#'.$key;
    }

    private static function normalize(mixed $value): mixed
    {
        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        if ($value instanceof UnitEnum) {
            return $value->name;
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s');
        }

        if (is_array($value)) {
            return $value;
        }

        if (is_object($value)) {
            return json_decode(json_encode($value), true);
        }

        return $value;
    }

    private static function ignored(string $key): bool
    {
        return in_array($key, ['created_at', 'updated_at', 'remember_token'], true);
    }

    private static function sensitive(string $key): bool
    {
        return $key === 'password' || str_ends_with($key, '_token');
    }

    private static function shouldSkip(): bool
    {
        return app()->runningInConsole() && ! app()->runningUnitTests();
    }
}

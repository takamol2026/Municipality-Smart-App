<?php

namespace Database\Seeders\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RuntimeException;

trait UpsertsSeed
{
    protected function seedCount(): int
    {
        return 150;
    }

    protected function upsert(string $model, array $lookup, array $values): Model
    {
        $usesSoftDeletes = in_array(SoftDeletes::class, class_uses_recursive($model), true);

        $record = ($usesSoftDeletes ? $model::withTrashed() : $model::query())
            ->updateOrCreate($lookup, $values);

        if ($usesSoftDeletes && $record->trashed()) {
            $record->restore();
        }

        return $record;
    }

    protected function adminId(): int
    {
        $id = User::query()->where('username', 'admin')->value('id');

        if (! $id) {
            throw new RuntimeException('کاربر admin پیدا نشد. ابتدا UserSeeder را اجرا کنید.');
        }

        return (int) $id;
    }
}

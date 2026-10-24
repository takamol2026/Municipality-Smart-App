<?php

namespace App\Models;

use App\Enums\AuditAction;
use App\Enums\ComplaintStatus;
use App\Enums\Language;
use App\Enums\PublishStatus;
use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'auditable_type',
        'auditable_id',
        'record_label',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'url',
    ];

    protected function casts(): array
    {
        return [
            'action' => AuditAction::class,
            'old_values' => 'array',
            'new_values' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return list<class-string<Model>>
     */
    public static function subjectTypes(): array
    {
        return [
            User::class,
            Role::class,
            RoleUser::class,
            District::class,
            DistrictFile::class,
            UrbanService::class,
            UrbanServiceCategory::class,
            HistoricalAttraction::class,
            HistoricalAttractionCategory::class,
            Scholar::class,
            Announcement::class,
            AnnouncementCategory::class,
            Project::class,
            ProjectCategory::class,
            ProjectMedia::class,
            MapLocation::class,
            MapCategory::class,
            MapMedia::class,
            Rental::class,
            RentalCategory::class,
            Safaei::class,
            SafaeiCategory::class,
            SafaeiPhoto::class,
            Complaint::class,
            Suggestion::class,
        ];
    }

    public function subjectLabel(): string
    {
        if ($this->auditable_type === null) {
            return __('audit.subjects.auth');
        }

        $key = 'audit.subjects.'.class_basename($this->auditable_type);
        $label = __($key);

        return $label === $key ? class_basename($this->auditable_type) : $label;
    }

    public function actorName(): string
    {
        if ($this->user) {
            $name = trim($this->user->name.' '.$this->user->last_name);

            return $name !== '' ? $name : ($this->user->username ?: __('audit.system'));
        }

        if ($this->action === AuditAction::LoginFailed) {
            $login = $this->new_values['login'] ?? null;

            if (is_string($login) && $login !== '') {
                return $login;
            }
        }

        return __('audit.system');
    }

    public function fieldLabel(string $field): string
    {
        $key = 'audit.fields.'.$field;
        $label = __($key);

        return $label === $key ? str_replace('_', ' ', $field) : $label;
    }

    public function presentValue(string $field, mixed $value): string
    {
        if ($value === null || $value === '') {
            return '—';
        }

        if ($value === 'changed') {
            return __('audit.password_changed');
        }

        if ($value === 'hidden') {
            return __('audit.hidden');
        }

        if (is_bool($value)) {
            return $value ? __('common.active') : __('common.inactive');
        }

        if (is_array($value)) {
            return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '—';
        }

        $string = (string) $value;

        if ($field === 'status') {
            if ($string === 'active') {
                return __('common.active');
            }

            if ($string === 'inactive') {
                return __('common.inactive');
            }

            foreach ([ComplaintStatus::class, SuggestionStatus::class, PublishStatus::class] as $enum) {
                $case = $enum::tryFrom($string);

                if ($case !== null) {
                    return $case->label();
                }
            }
        }

        if ($field === 'lang') {
            $language = Language::tryFrom($string);

            if ($language !== null) {
                return $language->label();
            }
        }

        return $string;
    }

    /**
     * @return list<string>
     */
    public function changedFields(): array
    {
        return array_values(array_unique(array_merge(
            array_keys($this->old_values ?? []),
            array_keys($this->new_values ?? []),
        )));
    }
}

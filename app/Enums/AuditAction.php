<?php

namespace App\Enums;

enum AuditAction: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Deleted = 'deleted';
    case Restored = 'restored';
    case Login = 'login';
    case Logout = 'logout';
    case LoginFailed = 'login_failed';

    public function label(): string
    {
        return __('audit.actions.'.$this->value);
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Created, self::Login => 'bg-success-subtle text-success',
            self::Updated => 'bg-primary-subtle text-primary',
            self::Deleted => 'bg-danger-subtle text-danger',
            self::Restored => 'bg-info-subtle text-info',
            self::Logout => 'bg-secondary-subtle text-secondary',
            self::LoginFailed => 'bg-warning-subtle text-warning',
        };
    }
}

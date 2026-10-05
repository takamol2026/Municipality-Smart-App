<?php

namespace App\Enums;

enum PublishStatus: string
{
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case NotStarted = 'not_started';

    public function label(): string
    {
        return match ($this) {
            self::InProgress => 'در حال کار',
            self::Completed => 'تمام شده',
            self::NotStarted => 'هنوز شروع نشده',
        };
    }
}

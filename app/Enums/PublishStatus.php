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
            self::InProgress => __('projects.in_progress'),
            self::Completed => __('projects.completed'),
            self::NotStarted => __('projects.not_started'),
        };
    }
}

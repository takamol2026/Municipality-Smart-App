<?php

namespace App\Enums;

enum SuggestionStatus: string
{
    case Pending = 'pending';
    case Reviewing = 'reviewing';
    case Resolved = 'resolved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('suggestions.status_pending'),
            self::Reviewing => __('suggestions.status_reviewing'),
            self::Resolved => __('suggestions.status_resolved'),
            self::Rejected => __('suggestions.status_rejected'),
        };
    }
}

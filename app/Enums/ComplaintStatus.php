<?php

namespace App\Enums;

enum ComplaintStatus: string
{
    case Pending = 'pending';
    case Reviewing = 'reviewing';
    case Resolved = 'resolved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('complaints.status_pending'),
            self::Reviewing => __('complaints.status_reviewing'),
            self::Resolved => __('complaints.status_resolved'),
            self::Rejected => __('complaints.status_rejected'),
        };
    }
}

<?php

namespace App\Models;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Traits\ConvertsJalaliDates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use ConvertsJalaliDates;
    protected $fillable = [
        'announcement_category_id',
        'title',
        'lang',
        'slug',
        'short_description',
        'content',
        'image',
        'attachment',
        'publish_date',
        'expire_date',
        'status',
        'sort_order',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'publish_date' => 'date',
            'expire_date' => 'date',
            'lang' => Language::class,
            'status' => RecordStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AnnouncementCategory::class, 'announcement_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function jalaliDateAttributes(): array
    {
        return [
            'publish_date',
            'expire_date',
        ];
    }
}

<?php

namespace App\Models;

use App\Enums\Language;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricalAttraction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'historical_attraction_category_id',
        'name',
        'lang',
        'slug',
        'short_description',
        'description',
        'history',
        'address',
        'location',
        'latitude',
        'longitude',
        'image',
        'status',
        'sort_order',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'lang' => Language::class,
            'status' => RecordStatus::class,
            'sort_order' => 'integer',
            'latitude' => 'decimal:4',
            'longitude' => 'decimal:4',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(HistoricalAttractionCategory::class, 'historical_attraction_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

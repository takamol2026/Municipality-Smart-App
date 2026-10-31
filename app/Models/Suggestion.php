<?php

namespace App\Models;

use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'latitude',
        'longitude',
        'full_name',
        'phone',
        'district_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => SuggestionStatus::class,
            'latitude' => 'decimal:4',
            'longitude' => 'decimal:4',
        ];
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}

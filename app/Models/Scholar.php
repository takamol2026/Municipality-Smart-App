<?php

namespace App\Models;

use App\Enums\Language;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scholar extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'lang',
        'slug',
        'short_bio',
        'biography',
        'birth_date',
        'death_date',
        'education',
        'works',
        'image',
        'status',
        'sort_order',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'death_date' => 'date',
            'lang' => Language::class,
            'status' => RecordStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

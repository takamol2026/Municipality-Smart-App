<?php

namespace App\Models;

use App\Enums\Language;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrbanServiceCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'lang',
        'slug',
        'description',
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
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(UrbanService::class);
    }
}

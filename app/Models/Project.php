<?php

namespace App\Models;

use App\Enums\PublishStatus;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'project_category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'status',
        'location',
        'benefits',
        'start_date',
        'end_date',
        'image',
        'status_publish',
        'sort_order',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => RecordStatus::class,
            'status_publish' => PublishStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class);
    }
}

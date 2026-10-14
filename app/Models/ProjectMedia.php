<?php

namespace App\Models;

use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    protected $table = 'project_media';

    protected $fillable = [
        'project_id',
        'type',
        'title',
        'file',
        'thumbnail',
        'sort_order',
        'status',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'status' => RecordStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function typeLabel(): string
    {
        return match ($this->type) {
            'image' => __('common.image'),
            'video' => __('common.video'),
            'document' => __('common.document'),
            default => $this->type ?: '—',
        };
    }

    public function isImageFile(): bool
    {
        if ($this->type === 'image') {
            return true;
        }

        return in_array($this->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'], true);
    }

    public function isVideoFile(): bool
    {
        if ($this->type === 'video') {
            return true;
        }

        return in_array($this->extension(), ['mp4', 'webm', 'ogg', 'mov'], true);
    }

    public function previewPath(): ?string
    {
        if ($this->thumbnail) {
            return $this->thumbnail;
        }

        return $this->isImageFile() ? $this->file : null;
    }

    private function extension(): string
    {
        return strtolower(pathinfo((string) $this->file, PATHINFO_EXTENSION));
    }
}

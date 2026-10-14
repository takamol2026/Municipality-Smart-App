<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapMedia extends Model
{
    use SoftDeletes;

    protected $table = 'map_media';

    protected $fillable = [
        'type',
        'location',
        'map_location_id',
        'user_id',
    ];

    public function mapLocation(): BelongsTo
    {
        return $this->belongsTo(MapLocation::class);
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
        return $this->isImageFile() ? $this->location : null;
    }

    private function extension(): string
    {
        return strtolower(pathinfo((string) $this->location, PATHINFO_EXTENSION));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SafaeiPhoto extends Model
{
    protected $table = 'safaei_photo';

    protected $fillable = [
        'file_path',
        'safaei_id',
    ];

    public function safaei(): BelongsTo
    {
        return $this->belongsTo(Safaei::class);
    }

    public function fileName(): string
    {
        return $this->file_path ? basename($this->file_path) : '—';
    }

    public function isImageFile(): bool
    {
        $extension = strtolower(pathinfo((string) $this->file_path, PATHINFO_EXTENSION));

        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'], true);
    }
}

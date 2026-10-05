<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Safaei extends Model
{
    protected $table = 'safaei';

    protected $fillable = [
        'file_path',
        'safaei_category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SafaeiCategory::class, 'safaei_category_id');
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

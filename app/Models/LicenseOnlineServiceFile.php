<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicenseOnlineServiceFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'license_online_service_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(LicenseOnlineService::class, 'license_online_service_id');
    }

    public function isImage(): bool
    {
        return in_array($this->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true);
    }

    public function sizeLabel(): string
    {
        $bytes = max(0, (int) $this->file_size);

        if ($bytes < 1024) {
            return $bytes.' B';
        }

        if ($bytes < 1048576) {
            return $this->trimNumber($bytes / 1024).' KB';
        }

        return $this->trimNumber($bytes / 1048576).' MB';
    }

    private function extension(): string
    {
        return strtolower(pathinfo((string) ($this->file_name ?: $this->file_path), PATHINFO_EXTENSION));
    }

    private function trimNumber(float $value): string
    {
        return rtrim(rtrim(number_format($value, 1, '.', ''), '0'), '.');
    }
}

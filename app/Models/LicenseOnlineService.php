<?php

namespace App\Models;

use App\Enums\Language;
use App\Enums\LicenseOnlineServiceType;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicenseOnlineService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'name',
        'lang',
        'description',
        'image',
        'status',
        'sort_order',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'type' => LicenseOnlineServiceType::class,
            'lang' => Language::class,
            'status' => RecordStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(LicenseOnlineServiceFile::class);
    }
}

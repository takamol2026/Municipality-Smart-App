<?php

namespace App\Models;

use App\Enums\Language;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SafaeiCategory extends Model
{
    use SoftDeletes;

    protected $table = 'safaei_category';

    protected $fillable = [
        'name',
        'lang',
        'description',
        'status',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'lang' => Language::class,
            'status' => RecordStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function safaeis(): HasMany
    {
        return $this->hasMany(Safaei::class);
    }
}

<?php

namespace App\Models;

use App\Enums\RecordStatus;
use App\Enums\SocialNetwork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialLink extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'network',
        'url',
        'status',
        'sort_order',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'network' => SocialNetwork::class,
            'status' => RecordStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

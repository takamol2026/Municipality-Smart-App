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
}

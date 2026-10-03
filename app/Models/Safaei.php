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
}

<?php

namespace App\Models;

use App\Enums\Language;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rental_category_id',
        'name',
        'lang',
        'slug',
        'description',
        'address',
        'rental_price',
        'rental_period',
        'image',
        'status',
        'sort_order',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'rental_price' => 'integer',
            'rental_period' => 'integer',
            'lang' => Language::class,
            'status' => RecordStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(RentalCategory::class, 'rental_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

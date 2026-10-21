<?php

namespace App\Models;

use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => SuggestionStatus::class,
        ];
    }
}

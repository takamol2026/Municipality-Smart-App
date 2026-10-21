<?php

namespace App\Models;

use App\Enums\ComplaintStatus;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => ComplaintStatus::class,
        ];
    }
}

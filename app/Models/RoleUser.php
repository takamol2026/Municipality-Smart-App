<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Pivot
{
    use SoftDeletes;

    protected $table = 'role_user';

    public $incrementing = true;

    protected $fillable = [
        'role_id',
        'user_id',
    ];
}

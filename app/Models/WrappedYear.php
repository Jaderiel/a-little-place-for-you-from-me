<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WrappedYear extends Model
{
    protected $guarded = [];

    protected $casts = [
        'highlights' => 'array',
    ];
}

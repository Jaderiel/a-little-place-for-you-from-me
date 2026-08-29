<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $guarded = [];

    protected $casts = [
        'achieved_on' => 'date',
        'is_locked' => 'boolean',
    ];
}

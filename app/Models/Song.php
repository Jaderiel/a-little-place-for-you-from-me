<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}

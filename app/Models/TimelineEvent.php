<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimelineEvent extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
        'is_cinematic' => 'boolean',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class)->orderBy('sort_order');
    }

    public function scopeInOrder(Builder $query): Builder
    {
        return $query->orderBy('date')->orderBy('sort_order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TechStack extends Model
{
    protected $fillable = [
        'name',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function textColorClass(): string
    {
        return match ($this->color) {
            'blue' => 'text-blue-500',
            'rose' => 'text-rose-500',
            'emerald' => 'text-emerald-500',
            'amber' => 'text-amber-500',
            'indigo' => 'text-indigo-500',
            'orange' => 'text-orange-500',
            'teal' => 'text-teal-500',
            'purple' => 'text-purple-500',
            'cyan' => 'text-cyan-400',
            default => 'text-sky-500',
        };
    }
}


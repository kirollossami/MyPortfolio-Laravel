<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ArchitecturePillar extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'color',
        'bullets',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'bullets' => 'array',
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

    public function iconWrapperClasses(): string
    {
        return match ($this->color) {
            'cyan' => 'bg-cyan-500/15 border-cyan-500/30 text-cyan-400 shadow-cyan-500/20',
            'emerald' => 'bg-emerald-500/15 border-emerald-500/30 text-emerald-400 shadow-emerald-500/20',
            'purple' => 'bg-purple-500/15 border-purple-500/30 text-purple-400 shadow-purple-500/20',
            'amber' => 'bg-amber-500/15 border-amber-500/30 text-amber-400 shadow-amber-500/20',
            'sky' => 'bg-sky-500/15 border-sky-500/30 text-sky-400 shadow-sky-500/20',
            'rose' => 'bg-rose-500/15 border-rose-500/30 text-rose-400 shadow-rose-500/20',
            default => 'bg-indigo-500/15 border-indigo-500/30 text-indigo-400 shadow-indigo-500/20',
        };
    }
}


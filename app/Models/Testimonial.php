<?php

namespace App\Models;

use App\Services\MediaService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'author_name',
        'author_role',
        'author_subtitle',
        'author_image_path',
        'badge_text',
        'color',
        'quote',
        'is_rtl',
        'linkedin_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_rtl' => 'boolean',
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

    public function getAuthorImageUrlAttribute(): string
    {
        return MediaService::url($this->author_image_path, 'assets/img/profile/kirollos_nav_logo.png');
    }

    public function themeClasses(): array
    {
        return match ($this->color) {
            'indigo' => [
                'hover_border' => 'hover:border-indigo-400/40',
                'icon_box' => 'bg-indigo-500/15 text-indigo-400 shadow-indigo-500/10',
                'badge' => 'bg-indigo-500/10 border-indigo-500/30 text-indigo-400',
                'avatar_border' => 'border-indigo-400/40',
                'role_text' => 'text-indigo-300',
                'link_hover' => 'hover:border-indigo-400 hover:text-indigo-400',
            ],
            'emerald' => [
                'hover_border' => 'hover:border-emerald-400/40',
                'icon_box' => 'bg-emerald-500/15 text-emerald-400 shadow-emerald-500/10',
                'badge' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400',
                'avatar_border' => 'border-emerald-400/40',
                'role_text' => 'text-emerald-300',
                'link_hover' => 'hover:border-emerald-400 hover:text-emerald-400',
            ],
            'amber' => [
                'hover_border' => 'hover:border-amber-400/40',
                'icon_box' => 'bg-amber-500/15 text-amber-400 shadow-amber-500/10',
                'badge' => 'bg-amber-500/10 border-amber-500/30 text-amber-400',
                'avatar_border' => 'border-amber-400/40',
                'role_text' => 'text-amber-300',
                'link_hover' => 'hover:border-amber-400 hover:text-amber-400',
            ],
            default => [
                'hover_border' => 'hover:border-cyan-400/40',
                'icon_box' => 'bg-cyan-500/15 text-cyan-400 shadow-cyan-500/10',
                'badge' => 'bg-cyan-500/10 border-cyan-500/30 text-cyan-400',
                'avatar_border' => 'border-cyan-400/40',
                'role_text' => 'text-cyan-300',
                'link_hover' => 'hover:border-cyan-400 hover:text-cyan-400',
            ],
        };
    }
}


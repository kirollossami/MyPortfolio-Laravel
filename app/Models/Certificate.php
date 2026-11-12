<?php

namespace App\Models;

use App\Services\MediaService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'issuer',
        'badge_text',
        'color',
        'description',
        'issued_date',
        'image_path',
        'pdf_path',
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

    public function getImageUrlAttribute(): string
    {
        return MediaService::url($this->image_path);
    }

    public function getDownloadUrlAttribute(): string
    {
        return route('certificates.download', $this->slug);
    }

    public function themeClasses(): array
    {
        return match ($this->color) {
            'emerald' => [
                'hover_border' => 'hover:border-emerald-400/40',
                'thumb_hover' => 'hover:border-emerald-400',
                'badge' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400',
            ],
            'indigo' => [
                'hover_border' => 'hover:border-indigo-400/40',
                'thumb_hover' => 'hover:border-indigo-400',
                'badge' => 'bg-indigo-500/10 border-indigo-500/30 text-indigo-400',
            ],
            'purple' => [
                'hover_border' => 'hover:border-purple-400/40',
                'thumb_hover' => 'hover:border-purple-400',
                'badge' => 'bg-purple-500/10 border-purple-500/30 text-purple-400',
            ],
            'blue' => [
                'hover_border' => 'hover:border-blue-400/40',
                'thumb_hover' => 'hover:border-blue-400',
                'badge' => 'bg-blue-500/10 border-blue-500/30 text-blue-400',
            ],
            'amber' => [
                'hover_border' => 'hover:border-amber-400/40',
                'thumb_hover' => 'hover:border-amber-400',
                'badge' => 'bg-amber-500/10 border-amber-500/30 text-amber-400',
            ],
            default => [
                'hover_border' => 'hover:border-cyan-400/40',
                'thumb_hover' => 'hover:border-cyan-400',
                'badge' => 'bg-cyan-500/10 border-cyan-500/30 text-cyan-400',
            ],
        };
    }
}


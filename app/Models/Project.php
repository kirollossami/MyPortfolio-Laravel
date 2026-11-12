<?php

namespace App\Models;

use App\Services\MediaService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'framework',
        'framework_label',
        'architecture',
        'architecture_label',
        'image_path',
        'badge_text',
        'badge_color',
        'tech_tags',
        'short_description',
        'long_description',
        'highlights',
        'demo_url',
        'demo_label',
        'live_url',
        'github_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'tech_tags' => 'array',
        'highlights' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const FRAMEWORK_OPTIONS = [
        'dotnet' => 'ASP.NET Core / C#',
        'laravel' => 'Laravel / PHP',
        'nodejs' => 'Node.js',
        'other' => 'Other Stack',
    ];

    public const ARCHITECTURE_OPTIONS = [
        'clean' => 'Clean Architecture',
        'ntier' => 'N-Tier Architecture',
        'microservices' => 'RESTful APIs & Microservices',
        'mvc' => 'MVC & Modular Monolith',
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
        return MediaService::url($this->image_path, 'assets/img/projects/unistay.png');
    }

    public function toFrontendArray(): array
    {
        return [
            'id' => $this->slug,
            'title' => $this->title,
            'framework' => $this->framework,
            'frameworkLabel' => $this->framework_label,
            'arch' => $this->architecture,
            'archLabel' => $this->architecture_label,
            'image' => $this->image_url,
            'badge' => $this->badge_text ?? '',
            'badgeColor' => $this->badge_color ?: 'text-cyan-400 bg-black/80 border-white/15',
            'techTags' => $this->tech_tags ?? [],
            'shortDesc' => $this->short_description,
            'longDesc' => $this->long_description,
            'highlights' => $this->highlights ?? [],
            'demoUrl' => $this->demo_url ?: '',
            'demoLabel' => $this->demo_label ?: 'View Showcase / Demo',
            'liveUrl' => $this->live_url ?: '',
            'githubUrl' => $this->github_url ?: '',
        ];
    }
}


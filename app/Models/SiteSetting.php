<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    public const CACHE_KEY = 'portfolio.site_settings';

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
        static::deleted(fn () => Cache::forget(self::CACHE_KEY));
    }

    /**
     * Return all settings as a key => value associative array.
     */
    public static function allMap(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return self::query()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Retrieve a single setting value with optional default.
     */
    public static function getValue(string $key, mixed $default = null): mixed
    {
        $map = self::allMap();

        return $map[$key] ?? $default;
    }

    /**
     * Update or create a batch of settings cleanly.
     */
    public static function setMany(array $pairs, string $group = 'general'): void
    {
        foreach ($pairs as $key => $value) {
            self::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }
        Cache::forget(self::CACHE_KEY);
    }
}


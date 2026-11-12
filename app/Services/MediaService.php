<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Resolve a stored relative public path or external URL to a full asset URL.
     */
    public static function url(?string $path, ?string $fallback = null): string
    {
        $target = $path ?: $fallback;

        if (!$target) {
            return '';
        }

        if (Str::startsWith($target, ['http://', 'https://', '//'])) {
            return $target;
        }

        return asset(ltrim($target, '/'));
    }

    /**
     * Store an uploaded file inside public/uploads/{folder} and return the relative path.
     */
    public static function upload(UploadedFile $file, string $folder, ?string $oldPath = null): string
    {
        $destination = public_path('uploads/' . trim($folder, '/'));
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'bin');
        $baseName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $baseName = $baseName !== '' ? Str::limit($baseName, 50, '') : 'file';
        $filename = $baseName . '-' . Str::random(8) . '.' . $extension;

        $file->move($destination, $filename);

        if ($oldPath) {
            self::deleteUploadedFile($oldPath);
        }

        return 'uploads/' . trim($folder, '/') . '/' . $filename;
    }

    /**
     * Delete a file only if it resides in public/uploads/ (preserves original static assets).
     */
    public static function deleteUploadedFile(?string $path): void
    {
        if (!$path || !Str::startsWith(ltrim($path, '/'), 'uploads/')) {
            return;
        }

        $fullPath = public_path(ltrim($path, '/'));
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}


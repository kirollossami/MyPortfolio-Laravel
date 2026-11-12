<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ResumesController extends Controller
{
    public function resumedownload()
    {
        $relativePath = SiteSetting::getValue('resume_path', 'assets/pdf/resume.pdf');

        if (Str::startsWith($relativePath, ['http://', 'https://'])) {
            return redirect()->away($relativePath);
        }

        $file = public_path(ltrim($relativePath, '/'));

        if (!is_file($file)) {
            Log::error('Resume file not found: ' . $file);
            abort(404, 'Resume file not found.');
        }

        $brandName = Str::slug(SiteSetting::getValue('brand_name', 'Kirollos_Samy'), '_');

        return response()->download($file, "{$brandName}_Resume.pdf", [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        ]);
    }
}

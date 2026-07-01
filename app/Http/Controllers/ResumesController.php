<?php
// app/Http/Controllers/ResumesController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResumesController extends Controller
{
    public function resumedownload(){

        $file = public_path("assets/pdf/resume.pdf");

        if(!file_exists($file)){
            Log::error("Resume file not found: " . $file);
            abort(404, "Resume file not found.");
        }
        
        return response()->download($file, 'resume.pdf', [
        'Content-Type' => 'application/pdf',
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0'
]);

}


}

<?php
// app/Http/Controllers/ResumesController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResumesController extends Controller
{
    public function resumedownload(){

        $file = public_path("assets/pdf/resume.pdf");
        
        return response()->download($file, 'resume.pdf', [
        'Content-Type' => 'application/octet-stream',
        'Cache-Control' => 'no-cache, must-revalidate'
]);

}


}

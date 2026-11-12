<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchitecturePillar;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\KirobotEntry;
use App\Models\Project;
use App\Models\TechStack;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'active_projects' => Project::active()->count(),
            'certificates' => Certificate::count(),
            'testimonials' => Testimonial::count(),
            'pillars' => ArchitecturePillar::count(),
            'tech_stacks' => TechStack::count(),
            'kirobot_entries' => KirobotEntry::count(),
            'messages_total' => ContactMessage::count(),
            'messages_unread' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::ordered()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}


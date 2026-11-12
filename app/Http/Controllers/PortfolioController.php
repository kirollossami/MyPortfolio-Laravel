<?php

namespace App\Http\Controllers;

use App\Models\ArchitecturePillar;
use App\Models\Certificate;
use App\Models\KirobotEntry;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\TechStack;
use App\Models\Testimonial;

class PortfolioController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::allMap();
        $techStacks = TechStack::active()->ordered()->get();
        $pillars = ArchitecturePillar::active()->ordered()->get();
        $projects = Project::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get();
        $kirobotEntries = KirobotEntry::active()->ordered()->get();

        // Build dynamic framework filter options & counts from active projects
        $frameworkCounts = $projects->groupBy('framework')->map->count();
        $frameworkFilters = [];
        foreach (Project::FRAMEWORK_OPTIONS as $key => $label) {
            $count = $frameworkCounts->get($key, 0);
            if ($count > 0) {
                $frameworkFilters[$key] = ['label' => $label, 'count' => $count];
            }
        }
        foreach ($frameworkCounts as $key => $count) {
            if (!isset($frameworkFilters[$key])) {
                $frameworkFilters[$key] = ['label' => ucfirst($key), 'count' => $count];
            }
        }

        // Build dynamic architecture filter options & counts from active projects
        $archCounts = $projects->groupBy('architecture')->map->count();
        $archFilters = [];
        foreach (Project::ARCHITECTURE_OPTIONS as $key => $label) {
            $count = $archCounts->get($key, 0);
            if ($count > 0) {
                $archFilters[$key] = ['label' => $label, 'count' => $count];
            }
        }
        foreach ($archCounts as $key => $count) {
            if (!isset($archFilters[$key])) {
                $archFilters[$key] = ['label' => ucfirst($key), 'count' => $count];
            }
        }

        // Prepare frontend JS payloads
        $projectsPayload = $projects->map(fn (Project $p) => $p->toFrontendArray())->values();

        $certificatesPayload = $certificates->mapWithKeys(function (Certificate $cert) {
            $theme = $cert->themeClasses();
            return [
                $cert->slug => [
                    'title' => $cert->title,
                    'issuer' => $cert->issuer,
                    'badge' => $cert->badge_text,
                    'badgeClass' => $theme['badge'],
                    'image' => $cert->image_url,
                    'pdfUrl' => $cert->download_url,
                ],
            ];
        });

        $sectionExplanations = $kirobotEntries
            ->where('type', 'section')
            ->pluck('content', 'key')
            ->toArray();

        $knowledgeBase = $kirobotEntries
            ->where('type', 'keyword')
            ->pluck('content', 'key')
            ->toArray();

        return view('welcome', compact(
            'settings',
            'techStacks',
            'pillars',
            'projects',
            'certificates',
            'testimonials',
            'frameworkFilters',
            'archFilters',
            'projectsPayload',
            'certificatesPayload',
            'sectionExplanations',
            'knowledgeBase'
        ));
    }
}


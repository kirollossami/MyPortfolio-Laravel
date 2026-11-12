<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\MediaService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::allMap();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
            'meta_author' => 'required|string|max:150',
            'og_url' => 'nullable|url|max:255',

            'brand_name' => 'required|string|max:100',
            'brand_full_name' => 'required|string|max:150',
            'brand_subtitle' => 'required|string|max:150',

            'availability_text' => 'required|string|max:200',
            'hero_title_prefix' => 'nullable|string|max:100',
            'hero_title_highlight' => 'required|string|max:120',
            'hero_title_suffix' => 'nullable|string|max:200',
            'hero_description' => 'required|string|max:2000',

            'architecture_badge' => 'required|string|max:80',
            'architecture_title' => 'required|string|max:200',
            'architecture_subtitle' => 'required|string|max:500',

            'projects_badge' => 'required|string|max:80',
            'projects_title' => 'required|string|max:200',
            'projects_subtitle' => 'required|string|max:500',

            'credentials_badge' => 'required|string|max:80',
            'credentials_title' => 'required|string|max:200',
            'credentials_subtitle' => 'required|string|max:500',

            'testimonials_badge' => 'required|string|max:80',
            'testimonials_title' => 'required|string|max:200',
            'testimonials_subtitle' => 'required|string|max:500',

            'contact_badge' => 'required|string|max:80',
            'contact_title' => 'required|string|max:200',
            'contact_subtitle' => 'required|string|max:500',
            'contact_form_title' => 'required|string|max:150',
            'contact_form_subtitle' => 'required|string|max:250',
            'contact_notice' => 'required|string|max:500',

            'contact_email' => 'required|email|max:150',
            'whatsapp_display' => 'required|string|max:150',
            'whatsapp_url' => 'required|url|max:255',
            'whatsapp_number' => 'required|string|max:40',
            'linkedin_display' => 'required|string|max:150',
            'linkedin_url' => 'required|url|max:255',
            'github_url' => 'required|url|max:255',

            'footer_credit_name' => 'required|string|max:150',
            'footer_copyright' => 'required|string|max:255',
            'kirobot_greeting' => 'required|string|max:1000',

            'nav_logo' => 'nullable|image|max:4096',
            'hero_image' => 'nullable|image|max:6144',
            'favicon' => 'nullable|image|max:2048',
            'resume_file' => 'nullable|mimes:pdf|max:10240',
        ]);

        $textKeys = [
            'site_title', 'meta_description', 'meta_keywords', 'meta_author', 'og_url',
            'brand_name', 'brand_full_name', 'brand_subtitle',
            'availability_text', 'hero_title_prefix', 'hero_title_highlight', 'hero_title_suffix', 'hero_description',
            'architecture_badge', 'architecture_title', 'architecture_subtitle',
            'projects_badge', 'projects_title', 'projects_subtitle',
            'credentials_badge', 'credentials_title', 'credentials_subtitle',
            'testimonials_badge', 'testimonials_title', 'testimonials_subtitle',
            'contact_badge', 'contact_title', 'contact_subtitle', 'contact_form_title', 'contact_form_subtitle', 'contact_notice',
            'contact_email', 'whatsapp_display', 'whatsapp_url', 'whatsapp_number', 'linkedin_display', 'linkedin_url', 'github_url',
            'footer_credit_name', 'footer_copyright', 'kirobot_greeting',
        ];

        $pairs = [];
        foreach ($textKeys as $key) {
            $pairs[$key] = $validated[$key] ?? '';
        }

        $pairs['is_available'] = $request->boolean('is_available') ? '1' : '0';
        $pairs['kirobot_enabled'] = $request->boolean('kirobot_enabled') ? '1' : '0';

        // Handle media uploads
        if ($request->hasFile('nav_logo')) {
            $pairs['nav_logo_path'] = MediaService::upload(
                $request->file('nav_logo'),
                'profile',
                SiteSetting::getValue('nav_logo_path')
            );
        }

        if ($request->hasFile('hero_image')) {
            $pairs['hero_image_path'] = MediaService::upload(
                $request->file('hero_image'),
                'profile',
                SiteSetting::getValue('hero_image_path')
            );
        }

        if ($request->hasFile('favicon')) {
            $pairs['favicon_path'] = MediaService::upload(
                $request->file('favicon'),
                'profile',
                SiteSetting::getValue('favicon_path')
            );
        }

        if ($request->hasFile('resume_file')) {
            $pairs['resume_path'] = MediaService::upload(
                $request->file('resume_file'),
                'resume',
                SiteSetting::getValue('resume_path')
            );
        }

        SiteSetting::setMany($pairs, 'general');

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Site settings and media updated successfully.');
    }
}


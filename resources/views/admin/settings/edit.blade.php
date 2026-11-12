@extends('admin.layouts.app')

@section('title', 'Site & Hero Settings')
@section('page_title', 'Site, Hero, Contact & Media Settings')
@section('page_subtitle', 'Update brand identity, hero section, portrait photo, resume PDF, section headings, contact info, and SEO metadata.')

@section('content')
@php $v = fn (string $key, string $default = '') => old($key, $settings[$key] ?? $default); @endphp
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
  @csrf
  @method('PUT')

  <!-- Brand & Media -->
  <div class="panel-card p-6 space-y-5">
    <h2 class="text-base font-bold text-white border-b border-white/10 pb-3">Brand Identity &amp; Uploaded Assets</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Brand Short Name</label>
        <input type="text" name="brand_name" value="{{ $v('brand_name') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Full Name</label>
        <input type="text" name="brand_full_name" value="{{ $v('brand_full_name') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Navbar Subtitle</label>
        <input type="text" name="brand_subtitle" value="{{ $v('brand_subtitle') }}" required class="form-input">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 pt-2">
      <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-2">
        <label class="form-label">Navbar Avatar Logo</label>
        <img src="{{ \App\Services\MediaService::url($settings['nav_logo_path'] ?? '') }}" alt="Nav Logo" class="w-16 h-16 rounded-full object-cover border border-white/20">
        <input type="file" name="nav_logo" accept="image/*" class="text-xs text-slate-300 w-full">
      </div>
      <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-2">
        <label class="form-label">Hero Portrait Image</label>
        <img src="{{ \App\Services\MediaService::url($settings['hero_image_path'] ?? '') }}" alt="Hero Portrait" class="w-16 h-20 rounded-lg object-cover border border-white/20">
        <input type="file" name="hero_image" accept="image/*" class="text-xs text-slate-300 w-full">
      </div>
      <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-2">
        <label class="form-label">Favicon</label>
        <img src="{{ \App\Services\MediaService::url($settings['favicon_path'] ?? '') }}" alt="Favicon" class="w-12 h-12 rounded-lg object-contain border border-white/20">
        <input type="file" name="favicon" accept="image/*" class="text-xs text-slate-300 w-full">
      </div>
      <div class="p-4 rounded-xl bg-white/5 border border-white/10 space-y-2">
        <label class="form-label">Resume PDF</label>
        <div class="text-xs font-mono text-sky-400 truncate">{{ $settings['resume_path'] ?? 'Not set' }}</div>
        <a href="{{ route('download.resume') }}" class="text-xs text-emerald-400 hover:underline inline-block">Download Current PDF</a>
        <input type="file" name="resume_file" accept="application/pdf" class="text-xs text-slate-300 w-full">
      </div>
    </div>
  </div>

  <!-- Hero Section -->
  <div class="panel-card p-6 space-y-5">
    <h2 class="text-base font-bold text-white border-b border-white/10 pb-3">Hero Section</h2>
    <div class="flex flex-wrap items-center gap-6">
      <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
        <input type="checkbox" name="is_available" value="1" {{ $v('is_available', '1') === '1' ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-emerald-500">
        <span>Show Live Availability Badge</span>
      </label>
      <div class="flex-1 min-w-[260px]">
        <label class="form-label">Availability Badge Text</label>
        <input type="text" name="availability_text" value="{{ $v('availability_text') }}" required class="form-input">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Hero Title Prefix</label>
        <input type="text" name="hero_title_prefix" value="{{ $v('hero_title_prefix') }}" class="form-input">
      </div>
      <div>
        <label class="form-label">Hero Highlighted Words</label>
        <input type="text" name="hero_title_highlight" value="{{ $v('hero_title_highlight') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Hero Title Suffix</label>
        <input type="text" name="hero_title_suffix" value="{{ $v('hero_title_suffix') }}" class="form-input">
      </div>
    </div>

    <div>
      <label class="form-label">Hero Description (HTML &lt;strong&gt; allowed)</label>
      <textarea name="hero_description" rows="3" required class="form-input">{{ $v('hero_description') }}</textarea>
    </div>
  </div>

  <!-- Section Headers -->
  <div class="panel-card p-6 space-y-5">
    <h2 class="text-base font-bold text-white border-b border-white/10 pb-3">Section Headings &amp; Subtitles</h2>
    @foreach([
      ['prefix' => 'architecture', 'label' => 'Architecture Pillars Section'],
      ['prefix' => 'projects', 'label' => 'Projects Section'],
      ['prefix' => 'credentials', 'label' => 'Credentials / Certificates Section'],
      ['prefix' => 'testimonials', 'label' => 'Testimonials Section'],
    ] as $sec)
      <div class="p-4 rounded-xl bg-white/5 border border-white/5 space-y-3">
        <div class="text-xs font-mono text-sky-400 uppercase">{{ $sec['label'] }}</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="form-label">Badge</label>
            <input type="text" name="{{ $sec['prefix'] }}_badge" value="{{ $v($sec['prefix'].'_badge') }}" required class="form-input">
          </div>
          <div class="md:col-span-2">
            <label class="form-label">Title</label>
            <input type="text" name="{{ $sec['prefix'] }}_title" value="{{ $v($sec['prefix'].'_title') }}" required class="form-input">
          </div>
        </div>
        <div>
          <label class="form-label">Subtitle</label>
          <textarea name="{{ $sec['prefix'] }}_subtitle" rows="2" required class="form-input">{{ $v($sec['prefix'].'_subtitle') }}</textarea>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Contact & Social -->
  <div class="panel-card p-6 space-y-5">
    <h2 class="text-base font-bold text-white border-b border-white/10 pb-3">Contact Details &amp; Social Links</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Contact Section Badge</label>
        <input type="text" name="contact_badge" value="{{ $v('contact_badge') }}" required class="form-input">
      </div>
      <div class="md:col-span-2">
        <label class="form-label">Contact Section Title</label>
        <input type="text" name="contact_title" value="{{ $v('contact_title') }}" required class="form-input">
      </div>
    </div>
    <div>
      <label class="form-label">Contact Section Subtitle</label>
      <textarea name="contact_subtitle" rows="2" required class="form-input">{{ $v('contact_subtitle') }}</textarea>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Form Title</label>
        <input type="text" name="contact_form_title" value="{{ $v('contact_form_title') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Form Subtitle</label>
        <input type="text" name="contact_form_subtitle" value="{{ $v('contact_form_subtitle') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Direct Transmission Notice</label>
        <input type="text" name="contact_notice" value="{{ $v('contact_notice') }}" required class="form-input">
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Contact Email</label>
        <input type="email" name="contact_email" value="{{ $v('contact_email') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">WhatsApp Display Numbers</label>
        <input type="text" name="whatsapp_display" value="{{ $v('whatsapp_display') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">WhatsApp Reply Number (Digits Only)</label>
        <input type="text" name="whatsapp_number" value="{{ $v('whatsapp_number') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">WhatsApp URL</label>
        <input type="url" name="whatsapp_url" value="{{ $v('whatsapp_url') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">LinkedIn Display Handle</label>
        <input type="text" name="linkedin_display" value="{{ $v('linkedin_display') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">LinkedIn URL</label>
        <input type="url" name="linkedin_url" value="{{ $v('linkedin_url') }}" required class="form-input">
      </div>
      <div class="md:col-span-3">
        <label class="form-label">GitHub URL</label>
        <input type="url" name="github_url" value="{{ $v('github_url') }}" required class="form-input">
      </div>
    </div>
  </div>

  <!-- SEO, Footer & KiroBot -->
  <div class="panel-card p-6 space-y-5">
    <h2 class="text-base font-bold text-white border-b border-white/10 pb-3">SEO Metadata, Footer &amp; KiroBot</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="form-label">HTML Page Title</label>
        <input type="text" name="site_title" value="{{ $v('site_title') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Canonical / OG URL</label>
        <input type="url" name="og_url" value="{{ $v('og_url') }}" class="form-input">
      </div>
      <div>
        <label class="form-label">Meta Author</label>
        <input type="text" name="meta_author" value="{{ $v('meta_author') }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Footer Credit Name</label>
        <input type="text" name="footer_credit_name" value="{{ $v('footer_credit_name') }}" required class="form-input">
      </div>
    </div>
    <div>
      <label class="form-label">Meta Description</label>
      <textarea name="meta_description" rows="2" required class="form-input">{{ $v('meta_description') }}</textarea>
    </div>
    <div>
      <label class="form-label">Meta Keywords</label>
      <textarea name="meta_keywords" rows="2" class="form-input">{{ $v('meta_keywords') }}</textarea>
    </div>
    <div>
      <label class="form-label">Footer Copyright Text</label>
      <input type="text" name="footer_copyright" value="{{ $v('footer_copyright') }}" required class="form-input">
    </div>
    <div class="pt-2 space-y-3 border-t border-white/10">
      <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
        <input type="checkbox" name="kirobot_enabled" value="1" {{ $v('kirobot_enabled', '1') === '1' ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-cyan-500">
        <span>Enable KiroBot Floating AI Companion</span>
      </label>
      <div>
        <label class="form-label">KiroBot Initial Greeting</label>
        <textarea name="kirobot_greeting" rows="2" required class="form-input">{{ $v('kirobot_greeting') }}</textarea>
      </div>
    </div>
  </div>

  <div class="flex justify-end">
    <button type="submit" class="btn-primary !px-6 !py-3">
      <i class="bi bi-save"></i> Save All Settings
    </button>
  </div>
</form>
@endsection


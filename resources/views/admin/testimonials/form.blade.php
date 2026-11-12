@extends('admin.layouts.app')

@section('title', $testimonial->exists ? 'Edit Testimonial' : 'Add Testimonial')
@section('page_title', $testimonial->exists ? 'Edit Testimonial' : 'Add New Testimonial')

@section('content')
<div class="panel-card p-6 max-w-3xl">
  <form action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if($testimonial->exists) @method('PUT') @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Author Name *</label>
        <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Role / Title *</label>
        <input type="text" name="author_role" value="{{ old('author_role', $testimonial->author_role) }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Subtitle / Track</label>
        <input type="text" name="author_subtitle" value="{{ old('author_subtitle', $testimonial->author_subtitle) }}" class="form-input">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Badge Text *</label>
        <input type="text" name="badge_text" value="{{ old('badge_text', $testimonial->badge_text) }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Color Theme *</label>
        <select name="color" class="form-input">
          @foreach(['cyan','indigo','emerald','amber'] as $color)
            <option value="{{ $color }}" {{ old('color', $testimonial->color) === $color ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" min="0" class="form-input">
      </div>
    </div>

    <div>
      <label class="form-label">Quote / Endorsement *</label>
      <textarea name="quote" rows="3" required class="form-input">{{ old('quote', $testimonial->quote) }}</textarea>
    </div>

    <div>
      <label class="form-label">LinkedIn Proof URL</label>
      <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $testimonial->linkedin_url) }}" class="form-input">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl bg-white/5 border border-white/10">
      <div>
        <label class="form-label">Upload Author Photo</label>
        <input type="file" name="author_image" accept="image/*" class="text-xs text-slate-300 w-full">
        @if($testimonial->author_image_path)
          <img src="{{ $testimonial->author_image_url }}" alt="Preview" class="mt-2 w-14 h-14 rounded-full object-cover border border-white/10">
        @endif
      </div>
      <div>
        <label class="form-label">Or Existing Photo Path</label>
        <input type="text" name="author_image_path_manual" value="{{ old('author_image_path_manual', $testimonial->author_image_path) }}" class="form-input">
      </div>
    </div>

    <div class="flex flex-wrap gap-6">
      <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
        <input type="checkbox" name="is_rtl" value="1" {{ old('is_rtl', $testimonial->is_rtl) ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-sky-500">
        <span>Right-to-Left (Arabic Quote)</span>
      </label>

      <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-emerald-500">
        <span>Visible on Frontend</span>
      </label>
    </div>

    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
      <button type="submit" class="btn-primary">
        <i class="bi bi-save"></i> {{ $testimonial->exists ? 'Update Testimonial' : 'Create Testimonial' }}
      </button>
      <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection


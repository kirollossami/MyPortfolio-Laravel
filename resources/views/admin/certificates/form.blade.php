@extends('admin.layouts.app')

@section('title', $certificate->exists ? 'Edit Certificate' : 'Add Certificate')
@section('page_title', $certificate->exists ? 'Edit Certificate' : 'Add New Certificate')

@section('content')
<div class="panel-card p-6 max-w-3xl">
  <form action="{{ $certificate->exists ? route('admin.certificates.update', $certificate) : route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if($certificate->exists) @method('PUT') @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="md:col-span-2">
        <label class="form-label">Certificate Title *</label>
        <input type="text" name="title" value="{{ old('title', $certificate->title) }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Slug (optional)</label>
        <input type="text" name="slug" value="{{ old('slug', $certificate->slug) }}" class="form-input" placeholder="auto-generated">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="form-label">Issuer / Organization *</label>
        <input type="text" name="issuer" value="{{ old('issuer', $certificate->issuer) }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Issued Date / Class</label>
        <input type="text" name="issued_date" value="{{ old('issued_date', $certificate->issued_date) }}" class="form-input" placeholder="Dec 2025">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Badge Text *</label>
        <input type="text" name="badge_text" value="{{ old('badge_text', $certificate->badge_text) }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Color Theme *</label>
        <select name="color" class="form-input">
          @foreach(['emerald','indigo','cyan','purple','blue','amber'] as $color)
            <option value="{{ $color }}" {{ old('color', $certificate->color) === $color ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $certificate->sort_order ?? 0) }}" min="0" class="form-input">
      </div>
    </div>

    <div>
      <label class="form-label">Description *</label>
      <textarea name="description" rows="3" required class="form-input">{{ old('description', $certificate->description) }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl bg-white/5 border border-white/10">
      <div class="space-y-2">
        <label class="form-label">Upload Certificate Image</label>
        <input type="file" name="image" accept="image/*" class="text-xs text-slate-300 w-full">
        @if($certificate->image_path)
          <img src="{{ $certificate->image_url }}" alt="Preview" class="h-20 rounded border border-white/10 object-contain">
        @endif
        <label class="form-label pt-1">Or Image Path</label>
        <input type="text" name="image_path_manual" value="{{ old('image_path_manual', $certificate->image_path) }}" class="form-input">
      </div>
      <div class="space-y-2">
        <label class="form-label">Upload Certificate PDF</label>
        <input type="file" name="pdf_file" accept="application/pdf" class="text-xs text-slate-300 w-full">
        @if($certificate->pdf_path)
          <div class="text-xs font-mono text-sky-400 truncate">{{ $certificate->pdf_path }}</div>
        @endif
        <label class="form-label pt-1">Or PDF Path</label>
        <input type="text" name="pdf_path_manual" value="{{ old('pdf_path_manual', $certificate->pdf_path) }}" class="form-input">
      </div>
    </div>

    <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $certificate->is_active ?? true) ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-emerald-500">
      <span>Visible on Frontend</span>
    </label>

    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
      <button type="submit" class="btn-primary">
        <i class="bi bi-save"></i> {{ $certificate->exists ? 'Update Certificate' : 'Create Certificate' }}
      </button>
      <a href="{{ route('admin.certificates.index') }}" class="btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection


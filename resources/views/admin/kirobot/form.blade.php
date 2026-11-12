@extends('admin.layouts.app')

@section('title', $entry->exists ? 'Edit KiroBot Entry' : 'Add KiroBot Entry')
@section('page_title', $entry->exists ? 'Edit KiroBot Entry' : 'Add KiroBot Entry')

@section('content')
<div class="panel-card p-6 max-w-2xl">
  <form action="{{ $entry->exists ? route('admin.kirobot.update', $entry) : route('admin.kirobot.store') }}" method="POST" class="space-y-4">
    @csrf
    @if($entry->exists) @method('PUT') @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Entry Type *</label>
        <select name="type" class="form-input">
          <option value="keyword" {{ old('type', $entry->type) === 'keyword' ? 'selected' : '' }}>Keyword Explainer</option>
          <option value="section" {{ old('type', $entry->type) === 'section' ? 'selected' : '' }}>Section Radar</option>
        </select>
      </div>
      <div>
        <label class="form-label">Match Key *</label>
        <input type="text" name="key" value="{{ old('key', $entry->key) }}" required class="form-input" placeholder="e.g. clean architecture or hero">
      </div>
      <div>
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $entry->sort_order ?? 0) }}" min="0" class="form-input">
      </div>
    </div>

    <div>
      <label class="form-label">Label (optional)</label>
      <input type="text" name="label" value="{{ old('label', $entry->label) }}" class="form-input">
    </div>

    <div>
      <label class="form-label">Spoken &amp; Typed Explanation *</label>
      <textarea name="content" rows="4" required class="form-input">{{ old('content', $entry->content) }}</textarea>
    </div>

    <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $entry->is_active ?? true) ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-emerald-500">
      <span>Active</span>
    </label>

    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
      <button type="submit" class="btn-primary">
        <i class="bi bi-save"></i> {{ $entry->exists ? 'Update Entry' : 'Create Entry' }}
      </button>
      <a href="{{ route('admin.kirobot.index') }}" class="btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection


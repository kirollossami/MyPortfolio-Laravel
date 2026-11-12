@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page_title', 'Testimonials & Endorsements')
@section('page_subtitle', 'Manage mentor recommendations, RTL Arabic/English quotes, photos, and LinkedIn proof links.')

@section('header_actions')
  <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">
    <i class="bi bi-plus-lg"></i> Add Testimonial
  </a>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
  @forelse($testimonials as $item)
    @php $theme = $item->themeClasses(); @endphp
    <div class="panel-card p-5 flex flex-col justify-between space-y-4">
      <div class="space-y-3">
        <div class="flex items-center justify-between">
          <span class="px-2.5 py-0.5 rounded border {{ $theme['badge'] }} font-mono text-[11px] font-bold">{{ $item->badge_text }}</span>
          <span class="text-[11px] font-mono {{ $item->is_active ? 'text-emerald-400' : 'text-slate-500' }}">
            #{{ $item->sort_order }} &middot; {{ $item->is_active ? 'Active' : 'Hidden' }}
          </span>
        </div>
        <p class="text-sm text-slate-200 italic leading-relaxed" @if($item->is_rtl) style="direction: rtl; text-align: right;" @endif>
          "{{ $item->quote }}"
        </p>
      </div>
      <div class="space-y-3 pt-3 border-t border-white/10">
        <div class="flex items-center gap-3">
          <img src="{{ $item->author_image_url }}" alt="{{ $item->author_name }}" class="w-10 h-10 rounded-full object-cover border {{ $theme['avatar_border'] }}">
          <div class="min-w-0">
            <div class="text-sm font-bold text-white truncate">{{ $item->author_name }}</div>
            <div class="text-[11px] font-mono {{ $theme['role_text'] }} truncate">{{ $item->author_role }}</div>
          </div>
        </div>
        <div class="flex items-center justify-end gap-2">
          <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn-secondary !py-1.5 !px-3 !text-xs">Edit</a>
          <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this testimonial?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="panel-card p-8 text-center text-slate-400 md:col-span-3">No testimonials added yet.</div>
  @endforelse
</div>
@endsection


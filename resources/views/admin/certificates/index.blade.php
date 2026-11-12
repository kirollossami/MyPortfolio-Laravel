@extends('admin.layouts.app')

@section('title', 'Certificates')
@section('page_title', 'Verified Certificates & Credentials')
@section('page_subtitle', 'Manage certificate images, downloadable PDFs, issuers, and badges.')

@section('header_actions')
  <a href="{{ route('admin.certificates.create') }}" class="btn-primary">
    <i class="bi bi-plus-lg"></i> Add Certificate
  </a>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
  @forelse($certificates as $cert)
    @php $theme = $cert->themeClasses(); @endphp
    <div class="panel-card p-5 flex flex-col justify-between space-y-4">
      <div class="space-y-3">
        <div class="flex items-center justify-between">
          <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-14 h-14 rounded-xl object-contain bg-white/5 border border-white/10 p-1">
          <span class="px-2.5 py-0.5 rounded border {{ $theme['badge'] }} font-mono text-[11px] font-bold">{{ $cert->badge_text }}</span>
        </div>
        <div>
          <div class="text-xs font-mono text-cyan-400">{{ $cert->issuer }} &middot; {{ $cert->issued_date }}</div>
          <h3 class="text-base font-bold text-white mt-0.5">{{ $cert->title }}</h3>
        </div>
        <p class="text-xs text-slate-400 line-clamp-3">{{ $cert->description }}</p>
      </div>
      <div class="pt-3 border-t border-white/10 flex items-center justify-between gap-2">
        <span class="text-[11px] font-mono {{ $cert->is_active ? 'text-emerald-400' : 'text-slate-500' }}">
          #{{ $cert->sort_order }} &middot; {{ $cert->is_active ? 'Active' : 'Hidden' }}
        </span>
        <div class="flex items-center gap-2">
          <a href="{{ route('admin.certificates.edit', $cert) }}" class="btn-secondary !py-1.5 !px-3 !text-xs">Edit</a>
          <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" onsubmit="return confirm('Delete this certificate?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="panel-card p-8 text-center text-slate-400 md:col-span-3">No certificates added yet.</div>
  @endforelse
</div>
@endsection


@extends('admin.layouts.app')

@section('title', 'Architecture Pillars')
@section('page_title', 'Backend Architecture Pillars')
@section('page_subtitle', 'Manage the Core Pillars cards shown in the Architecture section.')

@section('header_actions')
  <a href="{{ route('admin.pillars.create') }}" class="btn-primary">
    <i class="bi bi-plus-lg"></i> Add Pillar
  </a>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
  @forelse($pillars as $pillar)
    <div class="panel-card p-6 flex flex-col justify-between space-y-4">
      <div class="space-y-3">
        <div class="flex items-center justify-between">
          <div class="w-11 h-11 rounded-xl border {{ $pillar->iconWrapperClasses() }} flex items-center justify-center text-lg">
            <i class="bi {{ $pillar->icon }}"></i>
          </div>
          <span class="px-2.5 py-0.5 rounded-full text-[11px] font-mono {{ $pillar->is_active ? 'bg-emerald-500/15 text-emerald-300' : 'bg-slate-700/40 text-slate-400' }}">
            Order #{{ $pillar->sort_order }} &middot; {{ $pillar->is_active ? 'Active' : 'Hidden' }}
          </span>
        </div>
        <h3 class="text-lg font-bold text-white">{{ $pillar->title }}</h3>
        <p class="text-xs text-slate-300 leading-relaxed">{{ $pillar->description }}</p>
        @if(!empty($pillar->bullets))
          <ul class="text-xs font-mono text-slate-400 space-y-1 pt-2 border-t border-white/10">
            @foreach($pillar->bullets as $bullet)
              <li>&bull; {{ $bullet }}</li>
            @endforeach
          </ul>
        @endif
      </div>
      <div class="flex items-center justify-end gap-2 pt-3 border-t border-white/10">
        <a href="{{ route('admin.pillars.edit', $pillar) }}" class="btn-secondary !py-1.5 !px-3 !text-xs">Edit</a>
        <form action="{{ route('admin.pillars.destroy', $pillar) }}" method="POST" onsubmit="return confirm('Delete this architecture pillar?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-danger">Delete</button>
        </form>
      </div>
    </div>
  @empty
    <div class="panel-card p-8 text-center text-slate-400 md:col-span-2">No architecture pillars yet.</div>
  @endforelse
</div>
@endsection


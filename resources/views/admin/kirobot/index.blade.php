@extends('admin.layouts.app')

@section('title', 'KiroBot Knowledge')
@section('page_title', 'KiroBot AI Knowledge & Section Radar')
@section('page_subtitle', 'Edit what KiroBot explains when users scroll across sections or click keywords.')

@section('header_actions')
  <a href="{{ route('admin.kirobot.create') }}" class="btn-primary">
    <i class="bi bi-plus-lg"></i> Add Entry
  </a>
@endsection

@section('content')
<div class="flex flex-wrap gap-2">
  <a href="{{ route('admin.kirobot.index') }}" class="btn-secondary !text-xs {{ !$type ? '!border-sky-400 !text-sky-300' : '' }}">All Entries</a>
  <a href="{{ route('admin.kirobot.index', ['type' => 'section']) }}" class="btn-secondary !text-xs {{ $type === 'section' ? '!border-sky-400 !text-sky-300' : '' }}">Section Radar</a>
  <a href="{{ route('admin.kirobot.index', ['type' => 'keyword']) }}" class="btn-secondary !text-xs {{ $type === 'keyword' ? '!border-sky-400 !text-sky-300' : '' }}">Keyword Explainers</a>
</div>

<div class="panel-card overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
      <thead class="bg-white/5 text-xs font-mono uppercase text-slate-400">
        <tr>
          <th class="px-5 py-3.5">Type</th>
          <th class="px-5 py-3.5">Key</th>
          <th class="px-5 py-3.5">Explanation</th>
          <th class="px-5 py-3.5">Status</th>
          <th class="px-5 py-3.5 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/5">
        @forelse($entries as $entry)
          <tr class="hover:bg-white/[0.02]">
            <td class="px-5 py-3.5">
              <span class="px-2 py-0.5 rounded font-mono text-[11px] {{ $entry->type === 'section' ? 'bg-indigo-500/15 text-indigo-300' : 'bg-cyan-500/15 text-cyan-300' }}">
                {{ strtoupper($entry->type) }}
              </span>
            </td>
            <td class="px-5 py-3.5 font-mono text-xs text-white font-semibold">{{ $entry->key }}</td>
            <td class="px-5 py-3.5 text-xs text-slate-300 max-w-md truncate">{{ $entry->content }}</td>
            <td class="px-5 py-3.5">
              <span class="px-2 py-0.5 rounded-full text-[11px] font-mono {{ $entry->is_active ? 'bg-emerald-500/15 text-emerald-300' : 'bg-slate-700/40 text-slate-400' }}">
                {{ $entry->is_active ? 'Active' : 'Hidden' }}
              </span>
            </td>
            <td class="px-5 py-3.5 text-right space-x-2 whitespace-nowrap">
              <a href="{{ route('admin.kirobot.edit', $entry) }}" class="btn-secondary !py-1.5 !px-3 !text-xs">Edit</a>
              <form action="{{ route('admin.kirobot.destroy', $entry) }}" method="POST" class="inline" onsubmit="return confirm('Delete this entry?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-5 py-8 text-center text-slate-400">No KiroBot entries found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection


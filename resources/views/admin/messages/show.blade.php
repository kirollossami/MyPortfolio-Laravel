@extends('admin.layouts.app')

@section('title', 'View Inquiry')
@section('page_title', $message->subject)
@section('page_subtitle', 'From ' . $message->name . ' (' . $message->email . ')')

@section('header_actions')
  <a href="{{ route('admin.messages.index') }}" class="btn-secondary !text-xs">&larr; Back to Inbox</a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2 panel-card p-6 space-y-5">
    <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-white/10">
      <div>
        <div class="text-base font-bold text-white">{{ $message->name }}</div>
        <a href="mailto:{{ $message->email }}" class="text-xs font-mono text-sky-400 hover:underline">{{ $message->email }}</a>
      </div>
      <div class="text-right text-xs font-mono text-slate-400">
        <div>{{ $message->created_at->format('M d, Y h:i A') }}</div>
        <div>IP: {{ $message->ip_address ?? 'N/A' }}</div>
      </div>
    </div>

    <div class="p-4 rounded-xl bg-white/5 border border-white/10 text-sm text-slate-100 whitespace-pre-line leading-relaxed">
      {{ $message->message }}
    </div>

    <div class="flex flex-wrap items-center gap-3 pt-2">
      <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: ' . $message->subject) }}" class="btn-primary">
        <i class="bi bi-reply-fill"></i> Reply via Email
      </a>

      <form action="{{ route('admin.messages.toggle-read', $message) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn-secondary">
          <i class="bi {{ $message->is_read ? 'bi-envelope' : 'bi-envelope-open' }}"></i>
          <span>{{ $message->is_read ? 'Mark as Unread' : 'Mark as Read' }}</span>
        </button>
      </form>

      <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-danger !py-2.5 !px-4">
          <i class="bi bi-trash"></i> Delete
        </button>
      </form>
    </div>
  </div>

  <div class="panel-card p-6 space-y-4">
    <h2 class="text-sm font-bold text-white uppercase font-mono tracking-wider">Admin Notes</h2>
    <form action="{{ route('admin.messages.notes', $message) }}" method="POST" class="space-y-3">
      @csrf
      @method('PATCH')
      <textarea name="admin_notes" rows="6" class="form-input" placeholder="Private follow-up notes...">{{ old('admin_notes', $message->admin_notes) }}</textarea>
      <button type="submit" class="btn-primary w-full justify-center">
        <i class="bi bi-save"></i> Save Notes
      </button>
    </form>
  </div>
</div>
@endsection


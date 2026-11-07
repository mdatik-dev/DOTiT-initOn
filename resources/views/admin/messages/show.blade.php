@extends('admin.layout')
@section('title', 'Message from '.$contactMessage->name)
@section('heading', 'Contact message')
@section('content')
  @php($initials = collect(preg_split('/\s+/', trim($contactMessage->name)))->filter()->take(2)->map(fn($part) => strtoupper(substr($part, 0, 1)))->implode(''))
  <div class="message-detail-top">
    <a class="message-back" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-arrow-left"></i> All messages</a>
    <form method="POST" action="{{ route('admin.messages.destroy', $contactMessage) }}" onsubmit="return confirm('Permanently delete this message?')">
      @csrf @method('DELETE')
      <button class="admin-button danger" type="submit"><i class="fa-solid fa-trash"></i> Delete message</button>
    </form>
  </div>
  <section class="admin-card message-detail-card">
    <div class="message-detail-head">
      <span class="message-detail-avatar">{{ $initials ?: 'M' }}</span>
      <div>
        <span class="message-status {{ $contactMessage->read_at ? 'read' : 'unread' }}"><i></i>{{ $contactMessage->read_at ? 'Read message' : 'Unread message' }}</span>
        <h2>{{ $contactMessage->name }}</h2>
        <p>{{ $contactMessage->email }}</p>
      </div>
      <div class="message-detail-date">
        <i class="fa-regular fa-clock"></i>
        <span>{{ $contactMessage->created_at->format('M j, Y') }}<small>{{ $contactMessage->created_at->format('h:i A') }}</small></span>
      </div>
    </div>
    <div class="message-detail-grid">
      <aside class="message-contact-details">
        <div><span><i class="fa-solid fa-user"></i> Name</span><strong>{{ $contactMessage->name }}</strong></div>
        <div><span><i class="fa-solid fa-envelope"></i> Email</span><a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></div>
        @if($contactMessage->phone)
          <div><span><i class="fa-solid fa-phone"></i> Phone</span><a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a></div>
        @endif
        @if($contactMessage->service)
          <div><span><i class="fa-solid fa-layer-group"></i> Interested in</span><strong>{{ $contactMessage->service }}</strong></div>
        @endif
      </aside>
      <div class="message-body-panel">
        <div class="message-body-label"><span>Message</span><span>#{{ $contactMessage->id }}</span></div>
        <div class="admin-message-body">{{ $contactMessage->message }}</div>
      </div>
    </div>
  </section>
@endsection

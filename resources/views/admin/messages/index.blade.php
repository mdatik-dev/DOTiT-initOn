@extends('admin.layout')
@section('title', 'Contact messages')
@section('heading', 'Contact messages')
@section('content')
  <section class="admin-card message-list-card">
    <div class="message-list-head">
      <div>
        <span class="message-eyebrow">INBOX</span>
        <h2>Website inquiries</h2>
      </div>
      <div class="message-count"><strong>{{ $messages->total() }}</strong><span>Total messages</span></div>
    </div>
    @if($messages->isEmpty())
      <p class="admin-empty">No messages have been received yet.</p>
    @else
      <div class="message-table-wrap"><table class="admin-table message-table"><thead><tr><th>Status</th><th>Contact</th><th>Service</th><th>Received</th><th class="message-actions-heading">Actions</th></tr></thead><tbody>
      @foreach($messages as $message)
        @php($initials = collect(preg_split('/\s+/', trim($message->name)))->filter()->take(2)->map(fn($part) => strtoupper(substr($part, 0, 1)))->implode(''))
        <tr class="{{ $message->read_at ? '' : 'message-unread-row' }}">
          <td><span class="message-status {{ $message->read_at ? 'read' : 'unread' }}"><i></i>{{ $message->read_at ? 'Read' : 'Unread' }}</span></td>
          <td>
            <div class="message-contact">
              <span class="message-avatar">{{ $initials ?: 'M' }}</span>
              <div><a class="message-name" href="{{ route('admin.messages.show', $message) }}">{{ $message->name }}</a><span>{{ $message->email }}</span></div>
            </div>
          </td>
          <td><span class="message-service">{{ $message->service ?: 'General inquiry' }}</span></td>
          <td><span class="message-date">{{ $message->created_at->format('M j, Y') }}<small>{{ $message->created_at->format('h:i A') }}</small></span></td>
          <td>
            <div class="message-actions">
              <a class="message-action view" href="{{ route('admin.messages.show', $message) }}" title="View message" aria-label="View message from {{ $message->name }}"><i class="fa-solid fa-eye"></i><span>View</span></a>
              <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Permanently delete this message from {{ addslashes($message->name) }}?')">
                @csrf @method('DELETE')
                <button class="message-action delete" type="submit" title="Delete message" aria-label="Delete message from {{ $message->name }}"><i class="fa-solid fa-trash"></i><span>Delete</span></button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody></table></div>
      <div class="admin-pagination">{{ $messages->links() }}</div>
    @endif
  </section>
@endsection

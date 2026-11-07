@extends('admin.layout')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('content')
  <section class="dashboard-welcome">
    <div class="dashboard-welcome-copy">
      <span class="dashboard-eyebrow"><i class="fa-solid fa-sparkles" aria-hidden="true"></i> YOUR WEBSITE AT A GLANCE</span>
      <h2>Welcome to your control center</h2>
      <p>Manage your website content, services, and customer inquiries in one place.</p>
      <div class="dashboard-quick-links">
        <a class="admin-button" href="{{ route('admin.services.create') }}"><i class="fa-solid fa-plus" aria-hidden="true"></i> Add a service</a>
        <a class="admin-button secondary" href="{{ route('admin.settings.edit') }}"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Edit website</a>
      </div>
    </div>
    <div class="dashboard-welcome-art" aria-hidden="true">
      <span class="dashboard-orbit dashboard-orbit-one"></span><span class="dashboard-orbit dashboard-orbit-two"></span>
      <i class="fa-solid fa-layer-group"></i>
    </div>
  </section>

  <div class="dashboard-section-heading"><div><span class="dashboard-eyebrow">OVERVIEW</span><h2>Website activity</h2></div><a href="{{ route('home') }}" target="_blank" rel="noopener">View live website <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></div>

  <div class="admin-stats">
    <div class="admin-card admin-stat"><div class="admin-stat-icon stat-icon-blue"><i class="fa-solid fa-layer-group" aria-hidden="true"></i></div><div><span>Total services</span><strong>{{ $serviceCount }}</strong><small>Across your website</small></div></div>
    <div class="admin-card admin-stat"><div class="admin-stat-icon stat-icon-green"><i class="fa-solid fa-circle-check" aria-hidden="true"></i></div><div><span>Active services</span><strong>{{ $activeServiceCount }}</strong><small>Currently published</small></div></div>
    <div class="admin-card admin-stat"><div class="admin-stat-icon stat-icon-violet"><i class="fa-regular fa-envelope" aria-hidden="true"></i></div><div><span>Contact messages</span><strong>{{ $messageCount }}</strong><small>All website inquiries</small></div></div>
    <div class="admin-card admin-stat"><div class="admin-stat-icon stat-icon-orange"><i class="fa-solid fa-inbox" aria-hidden="true"></i></div><div><span>Unread messages</span><strong>{{ $unreadCount }}</strong><small>Waiting for your review</small></div></div>
  </div>

  <section class="admin-card dashboard-recent">
    <div class="admin-actions"><div><span class="dashboard-eyebrow">STAY IN THE LOOP</span><h2>Recent contact messages</h2></div><a class="admin-button secondary" href="{{ route('admin.messages.index') }}">View all messages <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
    @if($recentMessages->isEmpty())
      <div class="admin-empty dashboard-empty"><span><i class="fa-regular fa-envelope-open" aria-hidden="true"></i></span><strong>All caught up</strong><p>No messages have been received yet.</p></div>
    @else
      <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Name</th><th>Email</th><th>Received</th><th>Status</th></tr></thead><tbody>
      @foreach($recentMessages as $message)
        <tr><td><a href="{{ route('admin.messages.show', $message) }}">{{ $message->name }}</a></td><td>{{ $message->email }}</td><td>{{ $message->created_at->format('M j, Y') }}</td><td><span class="admin-badge {{ $message->read_at ? 'muted' : '' }}">{{ $message->read_at ? 'Read' : 'Unread' }}</span></td></tr>
      @endforeach
      </tbody></table></div>
    @endif
  </section>
@endsection

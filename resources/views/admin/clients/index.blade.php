@extends('admin.layout')
@section('title', 'Clients')
@section('heading', 'Clients')
@section('content')
  <section class="admin-card">
    <div class="admin-actions">
      <div><h2>Manage client logos</h2><p class="admin-user">Clients appear in the homepage moving logo section.</p></div>
      <a class="admin-button" href="{{ route('admin.clients.create') }}"><i class="fa-solid fa-plus"></i> Add client</a>
    </div>
    @if($clients->isEmpty())
      <p class="admin-empty">No clients yet. Add the first company name.</p>
    @else
      <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Order</th><th>Client</th><th>Status</th><th>Actions</th></tr></thead><tbody>
      @foreach($clients as $client)
        <tr><td>{{ $client->sort_order }}</td><td><div class="admin-team-person">@if($client->logo_path)<img src="{{ asset('storage/'.$client->logo_path) }}" alt="">@else<span><i class="fa-solid fa-building"></i></span>@endif<strong>{{ $client->name }}</strong></div></td><td><span class="admin-badge {{ $client->is_active ? '' : 'muted' }}">{{ $client->is_active ? 'Published' : 'Hidden' }}</span></td><td><div class="admin-inline-actions"><a href="{{ route('admin.clients.edit', $client) }}">Edit</a><form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Delete this client?')">@csrf @method('DELETE')<button class="admin-button danger" type="submit">Delete</button></form></div></td></tr>
      @endforeach
      </tbody></table></div>
    @endif
  </section>
@endsection

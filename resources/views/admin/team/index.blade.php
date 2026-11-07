@extends('admin.layout')
@section('title', 'Our Team')
@section('heading', 'Our Team')
@section('content')
  <section class="admin-card">
    <div class="admin-actions">
      <div><h2>Manage team members</h2><p class="admin-user">Published profiles appear on the Our Team page.</p></div>
      <a class="admin-button" href="{{ route('admin.team.create') }}"><i class="fa-solid fa-plus" aria-hidden="true"></i> Add team member</a>
    </div>
    @if($teamMembers->isEmpty())
      <p class="admin-empty">No team members yet. Add the first profile to publish your team page.</p>
    @else
      <div class="admin-table-wrap">
        <table class="admin-table">
          <thead><tr><th>Order</th><th>Member</th><th>Status</th><th>CV</th><th>Actions</th></tr></thead>
          <tbody>
          @foreach($teamMembers as $teamMember)
            <tr>
              <td>{{ $teamMember->sort_order }}</td>
              <td><div class="admin-team-person">
                @if($teamMember->profile_photo_path)<img src="{{ route('team.photo', ['path' => $teamMember->profile_photo_path]) }}" alt="">@else<span><i class="fa-regular fa-user" aria-hidden="true"></i></span>@endif
                <div><strong>{{ $teamMember->name }}</strong><small>{{ $teamMember->role }}</small></div>
              </div></td>
              <td><span class="admin-badge {{ $teamMember->is_active ? '' : 'muted' }}">{{ $teamMember->is_active ? 'Published' : 'Hidden' }}</span></td>
              <td>{{ $teamMember->cv_file_path ? 'Uploaded' : '—' }}</td>
              <td><div class="admin-inline-actions"><a href="{{ route('admin.team.edit', $teamMember) }}">Edit</a><form method="POST" action="{{ route('admin.team.destroy', $teamMember) }}" onsubmit="return confirm('Delete this team member?')">@csrf @method('DELETE')<button class="admin-button danger" type="submit">Delete</button></form></div></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </section>
@endsection

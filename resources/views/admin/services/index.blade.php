@extends('admin.layout')
@section('title', 'Services')
@section('heading', 'Services')
@section('content')
  <section class="admin-card">
    <div class="service-category-tabs" role="tablist" aria-label="Service category">
      <a class="{{ $category === 'dotit' ? 'active' : '' }}" href="{{ route('admin.services.index', ['category' => 'dotit']) }}" role="tab"><i class="fa-solid fa-code"></i><span>DOTiT</span></a>
      <a class="{{ $category === 'initon' ? 'active' : '' }}" href="{{ route('admin.services.index', ['category' => 'initon']) }}" role="tab"><i class="fa-solid fa-bullhorn"></i><span>initOn</span></a>
    </div>
    <div class="admin-actions"><div><h2>Manage {{ $category === 'dotit' ? 'DOTiT' : 'initOn' }} services</h2><p class="admin-user">{{ $category === 'dotit' ? 'DOTiT technology services shown across the website.' : 'initOn marketing services for the digital growth team.' }}</p></div><a class="admin-button" href="{{ route('admin.services.create', ['category' => $category]) }}">Add service</a></div>
    @if($services->isEmpty())
      <p class="admin-empty">No services yet. Add your first service.</p>
    @else
      <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Order</th><th>Name</th><th>Status</th><th>Featured</th><th>Actions</th></tr></thead><tbody>
      @foreach($services as $service)
        <tr>
          <td>{{ $service->sort_order }}</td>
          <td><i class="{{ $service->icon }}"></i> &nbsp;{{ $service->name }}</td>
          <td><span class="admin-badge {{ $service->is_active ? '' : 'muted' }}">{{ $service->is_active ? 'Active' : 'Hidden' }}</span></td>
          <td>{{ $service->is_featured ? 'Yes' : 'No' }}</td>
          <td><div class="admin-inline-actions"><a class="admin-action edit" href="{{ route('admin.services.edit', $service) }}"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a><form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">@csrf @method('DELETE')<button class="admin-action delete" type="submit"><i class="fa-solid fa-trash"></i><span>Delete</span></button></form></div></td>
        </tr>
      @endforeach
      </tbody></table></div>
    @endif
  </section>
@endsection

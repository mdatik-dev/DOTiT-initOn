@extends('admin.layout')
@section('title', $client->exists ? 'Edit client' : 'Add client')
@section('heading', $client->exists ? 'Edit client' : 'Add client')
@section('content')
  <form class="admin-card admin-form" method="POST" enctype="multipart/form-data" action="{{ $client->exists ? route('admin.clients.update', $client) : route('admin.clients.store') }}">
    @csrf @if($client->exists) @method('PUT') @endif
    <div class="admin-form-grid">
      <div class="admin-field"><label for="name">Company / client name *</label><input id="name" name="name" value="{{ old('name', $client->name) }}" required maxlength="120"></div>
      <div class="admin-field"><label for="website_url">Website URL</label><input id="website_url" name="website_url" type="url" value="{{ old('website_url', $client->website_url) }}" maxlength="255" placeholder="https://..."></div>
      <div class="admin-field"><label for="sort_order">Display order</label><input id="sort_order" name="sort_order" type="number" min="0" max="65535" value="{{ old('sort_order', $client->sort_order ?? 0) }}" required></div>
      <div class="admin-field"><label>Company logo</label><div class="admin-upload-box" data-admin-upload data-preview-type="image"><input id="logo" name="logo" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><label class="admin-upload-drop" for="logo"><span class="admin-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span><strong>Choose a company logo</strong><small>JPG, PNG or WebP · up to 4 MB</small></label><div class="admin-upload-preview {{ $client->logo_path ? '' : 'is-empty' }}">@if($client->logo_path)<button class="admin-upload-remove" type="button" aria-label="Remove logo"><i class="fa-solid fa-xmark"></i></button><img src="{{ asset('storage/'.$client->logo_path) }}" alt="Current logo">@endif</div><input type="hidden" name="remove_logo" value="0"></div></div>
    </div>
    <input type="hidden" name="is_active" value="0"><label class="admin-checkbox"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $client->exists ? $client->is_active : true))> Published on homepage</label>
    <div class="admin-form-actions"><button class="admin-button" type="submit">{{ $client->exists ? 'Save changes' : 'Add client' }}</button><a class="admin-button secondary" href="{{ route('admin.clients.index') }}">Cancel</a></div>
  </form>
@endsection

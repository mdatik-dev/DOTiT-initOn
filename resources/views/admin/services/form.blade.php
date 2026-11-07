@extends('admin.layout')
@section('title', $service->exists ? 'Edit service' : 'Add service')
@section('heading', $service->exists ? 'Edit service' : 'Add service')
@section('content')
  <form class="admin-card admin-form" method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}">
    @csrf
    @if($service->exists) @method('PUT') @endif
    <div class="admin-form-grid">
      <div class="admin-field"><label for="name">Service name</label><input id="name" name="name" value="{{ old('name', $service->name) }}" required maxlength="120"></div>
      <div class="admin-field"><label for="category">Service provider</label><select id="category" name="category" required><option value="dotit" @selected(old('category', $service->category ?: $category) === 'dotit')>DOTiT</option><option value="initon" @selected(old('category', $service->category ?: $category) === 'initon')>initOn</option></select></div>
      <div class="admin-field"><label for="link_label">Link label</label><input id="link_label" name="link_label" value="{{ old('link_label', $service->link_label ?: 'Discuss') }}" required maxlength="40"></div>
      <div class="admin-field full"><label for="description">Description</label><textarea id="description" name="description" required maxlength="1000">{{ old('description', $service->description) }}</textarea></div>
      <div class="admin-field"><label for="icon">Font Awesome icon classes</label><input id="icon" name="icon" value="{{ old('icon', $service->icon ?: 'fa-solid fa-code') }}" required maxlength="100" placeholder="fa-solid fa-code"><small>Use an icon class from the Font Awesome set already loaded by the site.</small></div>
      <div class="admin-field"><label for="sort_order">Display order</label><input id="sort_order" name="sort_order" type="number" min="0" max="65535" value="{{ old('sort_order', $service->sort_order ?? 0) }}" required></div>
    </div>
    <input type="hidden" name="is_active" value="0">
    <label class="admin-checkbox"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->exists ? $service->is_active : true))> Published on the website</label>
    <input type="hidden" name="is_featured" value="0">
    <label class="admin-checkbox"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured))> Highlight this service</label>
    <div class="admin-form-actions"><button class="admin-button" type="submit">{{ $service->exists ? 'Save changes' : 'Create service' }}</button><a class="admin-button secondary" href="{{ route('admin.services.index', ['category' => old('category', $service->category ?: $category)]) }}">Cancel</a></div>
  </form>
@endsection

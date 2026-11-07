@extends('admin.layout')
@section('title', 'Gallery')
@section('heading', 'Gallery')
@section('content')
  <section class="admin-card">
    <div class="admin-actions">
      <div><h2>Manage Gallery</h2><p class="admin-user">Upload one or multiple images for the public Gallery page.</p></div>
    </div>

    <form class="admin-form" method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="admin-form-grid">
        <div class="admin-field">
          <label for="gallery-images">Gallery images *</label>
          <input id="gallery-images" class="admin-file-input" name="images[]" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" multiple required>
        </div>
        <div class="admin-field"><label for="gallery-title">Optional title</label><input id="gallery-title" name="title" value="{{ old('title') }}" maxlength="120" placeholder="Project or event name"></div>
        <div class="admin-field"><label for="gallery-order">Display order</label><input id="gallery-order" name="sort_order" type="number" min="0" max="65535" value="{{ old('sort_order', 0) }}"></div>
      </div>
      <div class="admin-form-actions"><button class="admin-button" type="submit"><i class="fa-solid fa-cloud-arrow-up"></i> Upload images</button></div>
    </form>
  </section>

  <section class="admin-card admin-gallery-section">
    @if($galleryImages->isEmpty())
      <p class="admin-empty">No gallery images uploaded yet.</p>
    @else
      <div class="admin-gallery-grid">
        @foreach($galleryImages as $image)
          <article class="admin-gallery-item">
            <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $image->title ?: 'Gallery image' }}">
            <div><strong>{{ $image->title ?: 'Untitled image' }}</strong><span>Order: {{ $image->sort_order }}</span></div>
            <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Delete this gallery image?')">
              @csrf @method('DELETE')
              <button class="admin-action delete" type="submit"><i class="fa-solid fa-trash"></i><span>Delete</span></button>
            </form>
          </article>
        @endforeach
      </div>
    @endif
  </section>
@endsection

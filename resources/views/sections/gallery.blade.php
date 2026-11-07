@php($galleryImages = \App\Models\GalleryImage::query()->where('is_active', true)->orderBy('sort_order')->latest()->get())
<section class="gallery-page">
  <div class="container">
    <div class="section-heading centered reveal">
      <div class="section-kicker">DOTiT • HIGHLIGHTS</div>
      <h2>Our <span>Gallery</span></h2>
      <p>A collection of our work, projects, team moments and memorable highlights.</p>
    </div>

    @if($galleryImages->isEmpty())
      <div class="gallery-empty"><i class="fa-solid fa-images"></i><p>Gallery images will be added soon.</p></div>
    @else
      <div class="gallery-grid">
        @foreach($galleryImages as $index => $image)
          <figure class="gallery-item gallery-item-{{ $index % 6 }} reveal">
            <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $image->title ?: 'DOTiT gallery image' }}" loading="lazy">
            @if($image->title)<figcaption>{{ $image->title }}</figcaption>@endif
          </figure>
        @endforeach
      </div>
    @endif
  </div>
</section>

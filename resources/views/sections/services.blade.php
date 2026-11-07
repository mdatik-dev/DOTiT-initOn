<section class="section services {{ $currentPage === 'services' ? 'services-page' : '' }}" id="services">
  <div class="container">
    <div class="section-heading centered reveal"><div class="section-kicker">02 / WHAT WE DO</div><h2>{{ $settings['services_heading_start'] }} <span>{{ $settings['services_heading_highlight'] }}</span></h2><p>{{ $settings['services_intro'] }}</p></div>
    @if($currentPage === 'services')
      <div class="service-provider-group reveal">
        <div class="service-provider-heading">
          <div><span class="service-provider-mark dotit"><i class="fa-solid fa-code"></i></span><div><small>TECHNOLOGY PARTNER</small><h2>DOTiT <span>Services</span></h2></div></div>
          <p>Technology, software and digital solutions built for performance, scale and lasting business value.</p>
        </div>
        <div class="service-grid service-grid-detailed">
          @foreach($services as $service)
            <article class="service-card service-card-dotit {{ $service->is_featured ? 'service-card-accent' : '' }} reveal">
              <span class="service-no">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
              <span class="service-icon-wrap"><i class="{{ $service->icon }}"></i></span>
              <h3>{{ $service->name }}</h3>
              <p>{{ $service->description }}</p>
              <a href="{{ route('pages.show', 'contact') }}">{{ $service->link_label }} <i class="fa-solid fa-arrow-right"></i></a>
            </article>
          @endforeach
        </div>
      </div>

      <div class="service-provider-divider reveal"><span></span><strong><i class="fa-solid fa-bolt"></i> GROWTH PARTNER</strong><span></span></div>

      <div class="service-provider-group initon-service-group reveal">
        <div class="service-provider-heading">
          <div><span class="service-provider-mark initon"><i class="fa-solid fa-bullhorn"></i></span><div><small>DIGITAL MARKETING PARTNER</small><h2>initOn <span>Services</span></h2></div></div>
          <p>Creative, advertising and growth services that turn your brand into a stronger digital presence.</p>
        </div>
        <div class="service-grid service-grid-detailed initon-service-grid">
          @foreach($initonServices as $service)
            <article class="service-card service-card-initon {{ $service->is_featured ? 'service-card-accent' : '' }} reveal">
              <span class="service-no">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
              <span class="service-icon-wrap"><i class="{{ $service->icon }}"></i></span>
              <h3>{{ $service->name }}</h3>
              <p>{{ $service->description }}</p>
              <a href="{{ route('pages.show', 'contact') }}">{{ $service->link_label }} <i class="fa-solid fa-arrow-right"></i></a>
            </article>
          @endforeach
        </div>
      </div>
    @else
      <div class="service-grid">
        @foreach($services as $service)
          <article class="service-card {{ $service->is_featured ? 'service-card-accent' : '' }} reveal"><span class="service-no">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><i class="{{ $service->icon }}"></i><h3>{{ $service->name }}</h3><p>{{ $service->description }}</p><a href="{{ route('pages.show', 'contact') }}">{{ $service->link_label }} <i class="fa-solid fa-arrow-right"></i></a></article>
        @endforeach
      </div>
    @endif
  </div>
</section>

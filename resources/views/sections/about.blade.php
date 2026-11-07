<section class="section about" id="about">
  <div class="container two-col">
    <div class="section-heading reveal"><div class="section-kicker">01 / ABOUT DOTiT</div><h2>{{ $settings['about_heading_start'] }} <span>{{ $settings['about_heading_highlight'] }}</span></h2></div>
    <div class="about-copy reveal"><p class="lead">{{ $settings['about_lead'] }}</p><p>{{ $settings['about_text'] }}</p><div class="signature"><span>Design</span><b>•</b><span>Develop</span><b>•</b><span>Digitalize</span></div></div>
  </div>
  <div class="container feature-strip reveal"><div><i class="fa-solid fa-layer-group"></i><span>Scalable Solutions</span></div><div><i class="fa-solid fa-bolt"></i><span>Performance Focused</span></div><div><i class="fa-solid fa-shield-halved"></i><span>Business Ready</span></div><div><i class="fa-solid fa-headset"></i><span>Dedicated Support</span></div></div>
  @if($currentPage === 'about')
    <div class="container about-story reveal">
      <div class="about-logo-card">
        @if($settings['about_logo_image'])
          <img src="{{ route('team.photo', ['path' => $settings['about_logo_image']]) }}" alt="{{ $siteSettings['site_name'] }} logo">
        @else
          <img src="{{ !empty($siteSettings['site_logo']) ? asset('storage/'.$siteSettings['site_logo']) : asset('assets/dotit-logo.jpg') }}" alt="{{ $siteSettings['site_name'] }} logo">
        @endif
      </div>
      <div class="about-story-content">
        <div class="section-kicker">OUR STORY</div>
        <h2>{{ $settings['about_story_heading'] }}</h2>
        <p>{{ $settings['about_story_text'] }}</p>
        @if($settings['about_feature_image'])
          <img class="about-feature-image" src="{{ route('team.photo', ['path' => $settings['about_feature_image']]) }}" alt="DOTiT team and technology">
        @else
          <img class="about-feature-image" src="{{ asset('assets/hero-rightside-banner.png') }}" alt="DOTiT technology solutions">
        @endif
      </div>
    </div>
    <div class="container about-values">
      <article class="about-value-card reveal">
        <span class="about-value-icon"><i class="fa-solid fa-eye" aria-hidden="true"></i></span>
        <div>
          <div class="section-kicker">01 / FUTURE</div>
          <h2>{{ $settings['vision_heading'] }}</h2>
          <p>{{ $settings['vision_text'] }}</p>
        </div>
      </article>
      <article class="about-value-card reveal">
        <span class="about-value-icon"><i class="fa-solid fa-bullseye" aria-hidden="true"></i></span>
        <div>
          <div class="section-kicker">02 / PURPOSE</div>
          <h2>{{ $settings['mission_heading'] }}</h2>
          <p>{{ $settings['mission_text'] }}</p>
        </div>
      </article>
    </div>
    <div class="container about-journey reveal">
      <div class="about-journey-heading">
        <div class="section-kicker">01 / MILESTONES</div>
        <h2>{{ $settings['journey_heading'] }}</h2>
        <p>{{ $settings['journey_intro'] }}</p>
      </div>
      @php
        $journeyItems = json_decode((string) $settings['journey_items'], true);
        if (!is_array($journeyItems)) $journeyItems = [];
      @endphp
      @if(count($journeyItems))
        <div class="about-timeline">
          @foreach($journeyItems as $index => $item)
            <article class="timeline-item {{ $index % 2 === 0 ? 'timeline-left' : 'timeline-right' }} reveal">
              <div class="timeline-marker"><span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span></div>
              <div class="timeline-card">
                <div class="timeline-year">{{ $item['year'] ?? '' }}</div>
                <p>{{ $item['text'] ?? '' }}</p>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  @endif
</section>

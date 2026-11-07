<section class="hero" id="home">
  <div class="hero-bg"></div><div class="hero-grid"></div><div class="orb orb-a"></div><div class="orb orb-b"></div>
  <div class="container hero-inner">
    <div class="hero-copy">
      <div class="eyebrow reveal"><span class="pulse"></span> TECHNOLOGY • SOFTWARE • DIGITAL GROWTH</div>
      <h1 class="hero-title"><span class="line">{{ $settings['hero_line_1'] }}</span><span class="line gradient-text">{{ $settings['hero_line_2'] }}</span><span class="line">{{ $settings['hero_line_3'] }}</span></h1>
      <p class="hero-text reveal">{{ Str::before($settings['hero_text'], 'initOn') }}@if(str_contains($settings['hero_text'], 'initOn'))<strong>initOn</strong>{{ Str::after($settings['hero_text'], 'initOn') }}@endif</p>
      <div class="hero-actions reveal"><a class="btn btn-primary" href="{{ route('pages.show', 'services') }}">Explore Services <i class="fa-solid fa-arrow-down"></i></a><a class="btn btn-ghost" href="{{ route('pages.show', 'contact') }}">Start a Project <i class="fa-solid fa-arrow-up-right-from-square"></i></a></div>
      <div class="hero-stats reveal"><div><strong>01</strong><span>Technology Partner</span></div><div><strong>{{ str_pad((string) $services->count(), 2, '0', STR_PAD_LEFT) }}+</strong><span>Core Solutions</span></div><div><strong>360°</strong><span>Digital Support</span></div></div>
    </div>
    <div class="hero-visual reveal-scale">
      <div class="visual-card"><img src="{{ asset('assets/hero-rightside-banner.png') }}" alt="{{ $siteSettings['site_name'] }} technology and initOn digital marketing visual"></div>
      <div class="floating-chip chip-one"><i class="fa-solid fa-code"></i> Custom Development</div>
      <div class="floating-chip chip-two"><i class="fa-solid fa-chart-line"></i> Digital Growth</div>
    </div>
  </div>
  <a href="#about" class="scroll-indicator"><span>SCROLL TO EXPLORE</span><i class="fa-solid fa-arrow-down"></i></a>
</section>

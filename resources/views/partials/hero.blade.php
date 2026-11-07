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
      <div class="visual-card hero-product-board" aria-label="DOTiT software and digital solution showcase">
        <div class="product-board-glow"></div>
        <div class="product-board-window">
          <div class="window-dots"><span></span><span></span><span></span></div>
          <div class="window-address"><i class="fa-solid fa-code"></i> dotit workspace</div>
          <div class="product-ready"><span><i class="fa-solid fa-code"></i></span><div><strong>Custom Development</strong><small>Web · Software · Mobile</small></div></div>
        </div>

        <div class="hero-board-grid">
          <article class="project-screen-card">
            <div class="screen-topbar">
              <span><i class="fa-solid fa-chart-column"></i> Growth</span>
              <small>↗ +248%</small>
            </div>
            <div class="laptop-screen">
              <div class="laptop-toolbar">
                <span></span><span></span><span></span>
                <div></div>
              </div>
              <div class="project-dashboard">
                <aside><i class="fa-solid fa-house"></i><i class="fa-solid fa-chart-line"></i><i class="fa-solid fa-users"></i><i class="fa-solid fa-gear"></i></aside>
                <div class="dashboard-main">
                  <div class="dashboard-heading"><span>Performance</span><b>May</b></div>
                  <div class="dashboard-chart">
                    <svg viewBox="0 0 180 70" role="img" aria-label="Growth chart">
                      <defs><linearGradient id="chartFill" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#4edcff" stop-opacity=".35"/><stop offset="100%" stop-color="#4edcff" stop-opacity="0"/></linearGradient></defs>
                      <path class="chart-area" d="M0 58 L25 48 L48 52 L74 34 L102 39 L126 22 L150 29 L180 12 L180 70 L0 70Z"/>
                      <path class="chart-line" d="M0 58 L25 48 L48 52 L74 34 L102 39 L126 22 L150 29 L180 12"/>
                    </svg>
                  </div>
                  <div class="dashboard-bars"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
                </div>
              </div>
            </div>
            <div class="laptop-base"><span></span></div>
          </article>

          <article class="mobile-project-card">
            <div class="phone-speaker"></div>
            <div class="phone-status"><span>9:41</span><span><i class="fa-solid fa-signal"></i><i class="fa-solid fa-wifi"></i><i class="fa-solid fa-battery-full"></i></span></div>
            <div class="phone-brand"><span><i class="fa-solid fa-code"></i></span><div></div></div>
            <strong>98%</strong>
            <small>Client satisfaction</small>
            <div class="phone-orbit"></div>
          </article>

          <article class="code-project-card">
            <div class="code-title"><i class="fa-solid fa-code"></i><span>build.ts</span></div>
            <pre><code><span>const</span> solution = <b>create</b>({
  brand: <em>'premium'</em>,
  stack: [<em>'React'</em>],
  scale: <em>∞</em>
});

<span>deploy</span>(solution)</code></pre>
          </article>

          <article class="toolkit-card">
            <div class="toolkit-title"><span><i class="fa-solid fa-wand-magic-sparkles"></i> Toolkit</span><small>POWERED</small></div>
            <div class="toolkit-orbit">
              <div class="toolkit-track">
                <div class="toolkit-icon react" title="React"><i class="fa-brands fa-react"></i><span>React</span></div>
                <div class="toolkit-icon php" title="PHP"><i class="fa-brands fa-php"></i><span>PHP</span></div>
                <div class="toolkit-icon mongo" title="MongoDB"><i class="fa-solid fa-leaf"></i><span>MongoDB</span></div>
                <div class="toolkit-icon laravel" title="Laravel"><i class="fa-brands fa-laravel"></i><span>Laravel</span></div>
                <div class="toolkit-icon nextjs" title="Next.js"><b class="nextjs-mark">N</b><span>Next.js</span></div>
              </div>
            </div>
          </article>
        </div>

      </div>
    </div>
  </div>
  <a href="#about" class="scroll-indicator"><span>SCROLL TO EXPLORE</span><i class="fa-solid fa-arrow-down"></i></a>
</section>

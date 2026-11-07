<section class="section initon" id="initon">
  <div class="container">
    <div class="partner-top reveal"><div><div class="section-kicker">03 / DIGITAL MARKETING PARTNER</div><h2>Meet <span>initOn.</span></h2><p>{{ $settings['partner_intro'] }}</p></div><div class="partner-badge"><span>DOTiT</span><i class="fa-solid fa-plus"></i><strong>initOn</strong></div></div>
    <div class="initon-layout">
      <div class="initon-logo-card reveal-scale"><img src="{{ asset('assets/initon-logo.png') }}" alt="initOn logo"><div class="mini-label">CREATIVE • BRANDING • DIGITAL MARKETING</div></div>
      <div class="marketing-list reveal">
        @foreach($initonServices as $service)
          <div class="marketing-item"><i class="{{ $service->icon }}"></i><span>{{ $service->name }}</span></div>
        @endforeach
      </div>
    </div>
  </div>
</section>

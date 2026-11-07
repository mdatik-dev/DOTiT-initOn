<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @php
    $brandName = $siteSettings['site_name'] ?? 'DOTiT Limited';
    $brandLogo = !empty($siteSettings['site_logo']) ? asset('storage/'.$siteSettings['site_logo']) : asset('assets/dotit-logo.jpg');
    $brandFavicon = !empty($siteSettings['site_favicon']) ? asset('storage/'.$siteSettings['site_favicon']) : asset('favicon.ico');
    $pageTitle = trim($__env->yieldContent('title', $siteSettings['site_title'] ?? 'DOTiT Limited | Technology & Digital Solutions'));
    $pageTitle = str_replace('DOTiT Limited', $brandName, $pageTitle);
  @endphp
  <meta name="description" content="{{ trim($__env->yieldContent('meta_description', $siteSettings['site_description'])) }}" />
  <meta name="theme-color" content="#07101f">
  <title>{{ $pageTitle }}</title>
  <link rel="icon" href="{{ $brandFavicon }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ $brandFavicon }}">
  <link rel="apple-touch-icon" href="{{ $brandLogo }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/site.css') }}?v=12" />
  <link rel="stylesheet" href="{{ asset('css/team.css') }}?v=5" />
  <link rel="stylesheet" href="{{ asset('css/about.css') }}?v=2" />
</head>
<body>
  <div class="cursor-glow"></div>
  <div class="noise"></div>

  <header class="header" id="header">
    <nav class="nav container">
      <a href="{{ route('home') }}" class="brand"><img src="{{ $brandLogo }}" alt="{{ $brandName }} logo"></a>
      <button class="menu-toggle" aria-label="Open menu" aria-expanded="false"><span></span><span></span><span></span></button>
      <div class="nav-links">
        <a class="{{ $currentPage === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        <a class="{{ $currentPage === 'about' ? 'active' : '' }}" href="{{ route('pages.show', 'about') }}">About</a>
        <a class="{{ request()->routeIs('team.*') ? 'active' : '' }}" href="{{ route('team.index') }}">Our Team</a>
        <a class="{{ $currentPage === 'services' ? 'active' : '' }}" href="{{ route('pages.show', 'services') }}">Services</a>
        <a class="{{ $currentPage === 'initon' ? 'active' : '' }}" href="{{ route('pages.show', 'initon') }}">initOn</a>
        <a class="{{ $currentPage === 'process' ? 'active' : '' }}" href="{{ route('pages.show', 'process') }}">Process</a>
        <a class="{{ $currentPage === 'contact' ? 'active' : '' }}" href="{{ route('pages.show', 'contact') }}">Contact</a>
        <a class="nav-cta" href="{{ route('pages.show', 'contact') }}">Let's Talk <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  <footer class="footer"><div class="container footer-inner"><div><img src="{{ $brandLogo }}" alt="{{ $brandName }}"><p>Design • Develop • Digitalize</p></div><div class="footer-links"><a href="{{ route('home') }}">Home</a><a href="{{ route('team.index') }}">Our Team</a><a href="{{ route('pages.show', 'services') }}">Services</a><a href="{{ route('pages.show', 'initon') }}">initOn</a><a href="{{ route('pages.show', 'contact') }}">Contact</a><a href="{{ route('admin.login') }}">Admin</a></div><div class="copyright">© <span id="year"></span> {{ $brandName }}. All rights reserved.</div></div></footer>
  <button class="back-top" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="{{ asset('js/script.js') }}?v=2"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @php
    $brandName = $siteSettings['site_name'] ?? 'DOTiT Limited';
    $brandLogo = !empty($siteSettings['site_logo']) ? asset('storage/'.$siteSettings['site_logo']) : asset('assets/dotit-logo.jpg');
    $brandFavicon = !empty($siteSettings['site_favicon']) ? asset('storage/'.$siteSettings['site_favicon']) : asset('favicon.ico');
  @endphp
  <title>@yield('title', 'Admin') | {{ $brandName }}</title>
  <link rel="icon" href="{{ $brandFavicon }}">
  <link rel="shortcut icon" href="{{ $brandFavicon }}">
  <script>
    try {
      document.documentElement.dataset.adminTheme = localStorage.getItem('dotit-admin-theme') === 'light' ? 'light' : 'dark';
    } catch {
      document.documentElement.dataset.adminTheme = 'dark';
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=3">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}?v=1">
  <link rel="stylesheet" href="{{ asset('css/admin-upload.css') }}?v=2">
  <link rel="stylesheet" href="{{ asset('css/admin-team.css') }}?v=1">
  <link rel="stylesheet" href="{{ asset('css/admin-messages.css') }}?v=1">
</head>
<body class="admin-body">
  <div class="admin-shell">
    <aside class="admin-sidebar">
      <button class="admin-sidebar-toggle" type="button" aria-label="Collapse sidebar" aria-expanded="true" title="Collapse sidebar"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
      <a class="admin-brand" href="{{ route('admin.dashboard') }}"><span class="admin-brand-mark"><img src="{{ $brandLogo }}" alt="{{ $brandName }} logo"><span class="admin-brand-icon"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></span></span><span class="admin-brand-copy"><strong>{{ $brandName }} <span>Admin</span></strong><small>CONTROL PANEL</small></span></a>
      <nav class="admin-nav">
        <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" data-label="Dashboard"><i class="fa-solid fa-gauge-high" aria-hidden="true"></i><span>Dashboard</span></a>
        <a class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}" data-label="Website content"><i class="fa-solid fa-globe" aria-hidden="true"></i><span>Website content</span></a>
        <a class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}" href="{{ route('admin.about.edit') }}" data-label="About"><i class="fa-solid fa-circle-info" aria-hidden="true"></i><span>About</span></a>
        <a class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}" data-label="Services"><i class="fa-solid fa-layer-group" aria-hidden="true"></i><span>Services</span></a>
        <a class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}" href="{{ route('admin.team.index') }}" data-label="Our Team"><i class="fa-solid fa-users" aria-hidden="true"></i><span>Our Team</span></a>
        <a class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}" href="{{ route('admin.clients.index') }}" data-label="Clients"><i class="fa-solid fa-building-user" aria-hidden="true"></i><span>Clients</span></a>
        <a class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}" data-label="Contact messages"><i class="fa-solid fa-envelope" aria-hidden="true"></i><span>Contact messages</span></a>
      </nav>
      <div class="admin-sidebar-bottom">
        <a href="{{ route('home') }}" target="_blank" rel="noopener">View website ↗</a>
        <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-logout" type="submit">Sign out</button></form>
      </div>
    </aside>
    <main class="admin-main">
      <header class="admin-topbar">
        <div><h1>@yield('heading', 'Dashboard')</h1><p>Manage your {{ $brandName }} website</p></div>
        <div class="admin-topbar-actions">
          <button class="admin-theme-toggle" type="button" aria-label="Switch to light theme" aria-pressed="false" title="Switch theme"><i class="fa-solid fa-sun" aria-hidden="true"></i><span>Light mode</span></button>
          <div class="admin-user"><i class="fa-regular fa-circle-user" aria-hidden="true"></i> {{ auth()->user()->name }}</div>
        </div>
      </header>
      <div class="admin-content">
        @if(session('success'))<div class="admin-alert" role="status">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="admin-error" role="alert">{{ $errors->first() }}</div>@endif
        @yield('content')
      </div>
    </main>
  </div>
  <script src="{{ asset('js/admin-theme.js') }}" defer></script>
  <script src="{{ asset('js/admin-upload.js') }}" defer></script>
  <script src="{{ asset('js/admin-slug.js') }}?v=1" defer></script>
</body>
</html>

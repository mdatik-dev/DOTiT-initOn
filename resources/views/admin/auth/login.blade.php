<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php
    $brandName = $siteSettings['site_name'] ?? 'DOTiT Limited';
    $brandLogo = !empty($siteSettings['site_logo']) ? asset('storage/'.$siteSettings['site_logo']) : asset('assets/dotit-logo.jpg');
    $brandFavicon = !empty($siteSettings['site_favicon']) ? asset('storage/'.$siteSettings['site_favicon']) : asset('favicon.ico');
  @endphp
  <title>Admin sign in | {{ $brandName }}</title>
  <link rel="icon" href="{{ $brandFavicon }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body admin-login-page">
  <div class="admin-login-glow admin-login-glow-one"></div>
  <div class="admin-login-glow admin-login-glow-two"></div>
  <main class="admin-login-card">
    <a class="admin-brand admin-login-brand" href="{{ route('home') }}">
      <span class="admin-brand-mark">
        <img src="{{ $brandLogo }}" alt="{{ $brandName }} logo">
        <span class="admin-brand-icon"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></span>
      </span>
      <span class="admin-brand-copy"><strong>DOTiT <span>Admin</span></strong><small>CONTROL PANEL</small></span>
    </a>
    <div class="admin-login-heading">
      <span class="admin-login-eyebrow"><i class="fa-solid fa-lock" aria-hidden="true"></i> SECURE ADMIN ACCESS</span>
      <h1>Welcome back</h1>
      <p>Sign in to manage your website.</p>
    </div>
    @if($errors->any())<div class="admin-error" role="alert">{{ $errors->first() }}</div>@endif
    <form class="admin-form" method="POST" action="{{ route('admin.login.store') }}">
      @csrf
      <div class="admin-field"><label for="email"><i class="fa-regular fa-envelope" aria-hidden="true"></i> Email address</label><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="username" autofocus></div>
      <div class="admin-field"><label for="password"><i class="fa-solid fa-key" aria-hidden="true"></i> Password</label><span class="admin-password-wrap"><input id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password"><button class="admin-password-toggle" type="button" aria-label="Show password" aria-pressed="false" aria-controls="password"><i class="fa-regular fa-eye" aria-hidden="true"></i></button></span></div>
      <div class="admin-login-options"><label class="admin-checkbox"><input type="checkbox" name="remember" value="1" @checked(old('remember'))> <span>Keep me signed in</span></label><span class="admin-login-private"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> Private &amp; secure</span></div>
      <button class="admin-button admin-login-submit" type="submit"><span>Sign in to dashboard</span><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
    </form>
    <a class="admin-back" href="{{ route('home') }}"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to website</a>
  </main>
  <script src="{{ asset('js/admin-login.js') }}" defer></script>
</body>
</html>

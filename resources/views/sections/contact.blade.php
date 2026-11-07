<section class="section contact {{ $currentPage === 'contact' ? 'contact-page' : '' }}" id="contact"><div class="container contact-grid">
  <div class="contact-top-row">
    <div class="contact-intro reveal"><div class="section-kicker">05 / CONTACT</div><h2>{{ $settings['contact_heading_start'] }} <span>{{ $settings['contact_heading_highlight'] }}</span></h2><p class="lead">{{ $settings['contact_intro'] }}</p>
      <div class="contact-list">
        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone']) }}"><i class="fa-solid fa-phone"></i><div><small>Phone</small><strong>{{ $settings['phone'] }}</strong></div></a>
        <a href="mailto:{{ $settings['email'] }}"><i class="fa-solid fa-envelope"></i><div><small>Email</small><strong>{{ $settings['email'] }}</strong></div></a>
        <a href="https://{{ preg_replace('~^https?://~i', '', $settings['website']) }}" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-globe"></i><div><small>Website</small><strong>{{ $settings['website'] }}</strong></div></a>
        <div><i class="fa-solid fa-location-dot"></i><div><small>Office</small><strong>{{ $settings['address'] }}</strong></div></div>
      </div>
    </div>
    <div class="contact-card reveal-scale"><div class="contact-card-glow"></div><img src="{{ !empty($siteSettings['site_logo']) ? asset('storage/'.$siteSettings['site_logo']) : asset('assets/dotit-logo.jpg') }}" alt="{{ $siteSettings['site_name'] }} logo"><h3>{{ $siteSettings['site_name'] }}</h3><p>Your Technology Partner for a Better Digital Future.</p><a class="btn btn-ghost" href="mailto:{{ $settings['email'] }}">Email Us <i class="fa-solid fa-paper-plane"></i></a></div>
  </div>
  <form class="contact-form contact-form-full reveal" id="contact-form" method="POST" action="{{ route('contact.store') }}">
    @csrf
    <input type="hidden" name="return_to" value="{{ $currentPage === 'contact' ? 'contact' : 'home' }}">
    <div class="contact-form-heading"><span class="contact-form-icon"><i class="fa-regular fa-paper-plane"></i></span><div><h3>Send us a message</h3><p>Share a few details and our team will get back to you.</p></div></div>
    @if(session('success'))<p class="form-success" role="status">{{ session('success') }}</p>@endif
    @if($errors->any())<p class="form-error" role="alert">Please review the highlighted fields.</p>@endif
    <div class="contact-form-fields">
      <label>Name<input name="name" value="{{ old('name') }}" placeholder="Your name" autocomplete="name" required maxlength="120">@error('name')<small class="field-error">{{ $message }}</small>@enderror</label>
      <label>Email<input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required maxlength="255">@error('email')<small class="field-error">{{ $message }}</small>@enderror</label>
      <label>Phone <span>(optional)</span><input name="phone" value="{{ old('phone') }}" placeholder="+880 1XXX-XXXXXX" autocomplete="tel" maxlength="40">@error('phone')<small class="field-error">{{ $message }}</small>@enderror</label>
      <label>Service <span>(optional)</span><select name="service"><option value="">Select a service</option>@foreach($services as $service)<option value="{{ $service->name }}" @selected(old('service') === $service->name)>{{ $service->name }}</option>@endforeach</select>@error('service')<small class="field-error">{{ $message }}</small>@enderror</label>
      <label class="contact-message-field">Message<textarea name="message" rows="5" placeholder="Tell us a little about your project..." required maxlength="5000">{{ old('message') }}</textarea>@error('message')<small class="field-error">{{ $message }}</small>@enderror</label>
    </div>
    <div class="contact-form-footer"><span><i class="fa-solid fa-lock"></i> Your information stays private.</span><button class="btn btn-primary" type="submit">Send Message <i class="fa-solid fa-paper-plane"></i></button></div>
  </form>
</div></section>

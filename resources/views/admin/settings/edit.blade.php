@extends('admin.layout')
@section('title', 'Website content')
@section('heading', 'Website content')
@section('content')
  @php
    $contentFields = [
      'hero_line_1' => 'Hero title — line 1',
      'hero_line_2' => 'Hero title — highlighted line',
      'hero_line_3' => 'Hero title — line 3',
      'hero_text' => 'Hero description',
      'services_heading_start' => 'Services title',
      'services_heading_highlight' => 'Services title highlight',
      'services_intro' => 'Services introduction',
      'partner_intro' => 'initOn introduction',
      'contact_heading_start' => 'Contact title',
      'contact_heading_highlight' => 'Contact title highlight',
      'contact_intro' => 'Contact introduction',
      'phone' => 'Phone number',
      'email' => 'Email address',
      'website' => 'Website address',
      'address' => 'Office address',
    ];
    $longFields = ['hero_text', 'services_intro', 'partner_intro', 'contact_intro', 'address'];
  @endphp
  <form class="admin-card admin-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')
    <div class="admin-settings-section">
      <div class="admin-settings-heading"><span><i class="fa-solid fa-palette"></i></span><div><h2>Brand identity</h2><p>Set the company name, browser title, favicon and main logo.</p></div></div>
      <div class="admin-form-grid">
        <div class="admin-field"><label for="settings-site_name">Website / company name *</label><input id="settings-site_name" name="settings[site_name]" value="{{ old('settings.site_name', $settings['site_name']) }}" required maxlength="120"></div>
        <div class="admin-field"><label for="settings-site_title">Website browser title *</label><input id="settings-site_title" name="settings[site_title]" value="{{ old('settings.site_title', $settings['site_title']) }}" required maxlength="5000"></div>
        <div class="admin-field full"><label for="settings-site_description">Website meta description *</label><textarea id="settings-site_description" name="settings[site_description]" required maxlength="5000" rows="3">{{ old('settings.site_description', $settings['site_description']) }}</textarea></div>
        <div class="admin-field"><label>Main website logo</label>
          <div class="admin-upload-box" data-admin-upload data-preview-type="image"><input id="site-logo" name="site_logo" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><label class="admin-upload-drop" for="site-logo"><span class="admin-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span><strong>Upload website logo</strong><small>JPG, PNG or WebP · up to 4 MB</small></label><div class="admin-upload-preview {{ $settings['site_logo'] ? '' : 'is-empty' }}">@if($settings['site_logo'])<button class="admin-upload-remove" type="button" aria-label="Remove website logo"><i class="fa-solid fa-xmark"></i></button><img src="{{ asset('storage/'.$settings['site_logo']) }}" alt="Current website logo">@endif</div><input type="hidden" name="remove_site_logo" value="0"></div>
        </div>
        <div class="admin-field"><label>Browser favicon</label>
          <div class="admin-upload-box" data-admin-upload data-preview-type="image"><input id="site-favicon" name="site_favicon" type="file" accept=".ico,.png,.jpg,.jpeg,.webp,image/x-icon,image/png,image/jpeg,image/webp"><label class="admin-upload-drop" for="site-favicon"><span class="admin-upload-icon"><i class="fa-solid fa-image"></i></span><strong>Upload favicon</strong><small>ICO, PNG, JPG or WebP · up to 1 MB</small></label><div class="admin-upload-preview {{ $settings['site_favicon'] ? '' : 'is-empty' }}">@if($settings['site_favicon'])<button class="admin-upload-remove" type="button" aria-label="Remove favicon"><i class="fa-solid fa-xmark"></i></button><img src="{{ asset('storage/'.$settings['site_favicon']) }}" alt="Current favicon">@endif</div><input type="hidden" name="remove_site_favicon" value="0"></div>
        </div>
      </div>
    </div>
    <div class="admin-settings-section">
      <div class="admin-settings-heading"><span><i class="fa-solid fa-globe"></i></span><div><h2>Website content</h2><p>Manage homepage headings, introductions and contact details.</p></div></div>
      <div class="admin-form-grid">
      @foreach($contentFields as $key => $label)
        <div class="admin-field {{ in_array($key, $longFields, true) ? 'full' : '' }}">
          <label for="settings-{{ $key }}">{{ $label }}</label>
          @if(in_array($key, $longFields, true))
            <textarea id="settings-{{ $key }}" name="settings[{{ $key }}]" required maxlength="5000">{{ old("settings.$key", $settings[$key]) }}</textarea>
          @else
            <input id="settings-{{ $key }}" name="settings[{{ $key }}]" value="{{ old("settings.$key", $settings[$key]) }}" required maxlength="5000">
          @endif
        </div>
      @endforeach
      </div>
    </div>
    <div class="admin-form-actions"><button class="admin-button" type="submit">Save website content</button></div>
  </form>
@endsection

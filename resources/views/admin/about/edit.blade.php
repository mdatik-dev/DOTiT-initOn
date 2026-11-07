@extends('admin.layout')
@section('title', 'About page')
@section('heading', 'About page')
@section('content')
  <form class="admin-card admin-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.about.update') }}">
    @csrf @method('PUT')
    <div class="admin-form-grid">
      <div class="admin-field"><label for="about-heading-start">About title</label><input id="about-heading-start" name="settings[about_heading_start]" value="{{ old('settings.about_heading_start', $settings['about_heading_start']) }}" required maxlength="5000"></div>
      <div class="admin-field"><label for="about-heading-highlight">About title highlight</label><input id="about-heading-highlight" name="settings[about_heading_highlight]" value="{{ old('settings.about_heading_highlight', $settings['about_heading_highlight']) }}" required maxlength="5000"></div>
      <div class="admin-field full"><label for="about-lead">About lead paragraph</label><textarea id="about-lead" name="settings[about_lead]" required maxlength="5000" rows="4">{{ old('settings.about_lead', $settings['about_lead']) }}</textarea></div>
      <div class="admin-field full"><label for="about-text">About description</label><textarea id="about-text" name="settings[about_text]" required maxlength="5000" rows="5">{{ old('settings.about_text', $settings['about_text']) }}</textarea></div>
      <div class="admin-field full"><label for="story-heading">Company story heading</label><input id="story-heading" name="settings[about_story_heading]" value="{{ old('settings.about_story_heading', $settings['about_story_heading']) }}" required maxlength="5000"></div>
      <div class="admin-field full"><label for="story-text">Company story text</label><textarea id="story-text" name="settings[about_story_text]" required maxlength="5000" rows="5">{{ old('settings.about_story_text', $settings['about_story_text']) }}</textarea></div>
      <div class="admin-field full">
        <div class="admin-value-editors">
          <section class="admin-value-editor">
            <div class="admin-value-editor-title"><span><i class="fa-solid fa-eye"></i></span><strong>Vision</strong></div>
            <label for="vision-heading">Vision heading</label>
            <input id="vision-heading" name="settings[vision_heading]" value="{{ old('settings.vision_heading', $settings['vision_heading']) }}" required maxlength="5000">
            <label for="vision-text">Vision text</label>
            <textarea id="vision-text" name="settings[vision_text]" required maxlength="5000" rows="4">{{ old('settings.vision_text', $settings['vision_text']) }}</textarea>
          </section>
          <section class="admin-value-editor">
            <div class="admin-value-editor-title"><span><i class="fa-solid fa-bullseye"></i></span><strong>Mission</strong></div>
            <label for="mission-heading">Mission heading</label>
            <input id="mission-heading" name="settings[mission_heading]" value="{{ old('settings.mission_heading', $settings['mission_heading']) }}" required maxlength="5000">
            <label for="mission-text">Mission text</label>
            <textarea id="mission-text" name="settings[mission_text]" required maxlength="5000" rows="4">{{ old('settings.mission_text', $settings['mission_text']) }}</textarea>
          </section>
        </div>
      </div>
      @php($journeyItems = json_decode((string) $settings['journey_items'], true))
      @if(!is_array($journeyItems) || !count($journeyItems))
        @php($journeyItems = [['year' => '', 'text' => '']])
      @endif
      <div class="admin-field"><label for="journey-heading">Journey heading</label><input id="journey-heading" name="settings[journey_heading]" value="{{ old('settings.journey_heading', $settings['journey_heading']) }}" required maxlength="5000"></div>
      <div class="admin-field"></div>
      <div class="admin-field full"><label for="journey-intro">Journey introduction</label><textarea id="journey-intro" name="settings[journey_intro]" required maxlength="5000" rows="3">{{ old('settings.journey_intro', $settings['journey_intro']) }}</textarea></div>
      <div class="admin-field full">
        <label>Journey milestones</label>
        <div class="admin-journey-list" id="admin-journey-list">
          @foreach($journeyItems as $item)
            <div class="admin-journey-row">
              <div class="admin-journey-year">
                <label>Year</label>
                <input name="journey_year[]" value="{{ $item['year'] ?? '' }}" required maxlength="20" placeholder="2023" aria-label="Journey year">
              </div>
              <div class="admin-journey-description">
                <label>Milestone description</label>
                <textarea name="journey_text[]" required maxlength="2000" rows="3" placeholder="What happened during this year?" aria-label="Journey milestone text">{{ $item['text'] ?? '' }}</textarea>
              </div>
              <button type="button" class="admin-journey-remove" title="Remove milestone" aria-label="Remove milestone"><i class="fa-solid fa-xmark"></i></button>
            </div>
          @endforeach
        </div>
        <button type="button" class="admin-button secondary" id="admin-journey-add"><i class="fa-solid fa-plus"></i> Add milestone</button>
      </div>
      <div class="admin-field">
        <label>About company logo</label>
        <div class="admin-upload-box" data-admin-upload data-preview-type="image">
          <input id="about-logo-image" name="about_logo_image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
          <label class="admin-upload-drop" for="about-logo-image"><span class="admin-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span><strong>Choose company logo</strong><small>JPG, PNG or WebP</small></label>
          <div class="admin-upload-preview {{ $settings['about_logo_image'] ? '' : 'is-empty' }}">
            @if($settings['about_logo_image'])<button class="admin-upload-remove" type="button" aria-label="Remove company logo"><i class="fa-solid fa-xmark"></i></button><img src="{{ route('team.photo', ['path' => $settings['about_logo_image']]) }}" alt="Current company logo">@endif
          </div>
          <input type="hidden" name="remove_about_logo_image" value="0">
        </div>
      </div>
      <div class="admin-field">
        <label>About section image</label>
        <div class="admin-upload-box" data-admin-upload data-preview-type="image">
          <input id="about-feature-image" name="about_feature_image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
          <label class="admin-upload-drop" for="about-feature-image"><span class="admin-upload-icon"><i class="fa-solid fa-image"></i></span><strong>Choose about section image</strong><small>JPG, PNG or WebP</small></label>
          <div class="admin-upload-preview {{ $settings['about_feature_image'] ? '' : 'is-empty' }}">
            @if($settings['about_feature_image'])<button class="admin-upload-remove" type="button" aria-label="Remove about image"><i class="fa-solid fa-xmark"></i></button><img src="{{ route('team.photo', ['path' => $settings['about_feature_image']]) }}" alt="Current about image">@endif
          </div>
          <input type="hidden" name="remove_about_feature_image" value="0">
        </div>
      </div>
    </div>
    <div class="admin-form-actions"><button class="admin-button" type="submit">Save About page</button></div>
  </form>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const list = document.getElementById('admin-journey-list');
      const addButton = document.getElementById('admin-journey-add');
      if (!list || !addButton) return;

      const bindRemoveButtons = () => {
        list.querySelectorAll('.admin-journey-remove').forEach((button) => {
          button.onclick = () => {
            const rows = list.querySelectorAll('.admin-journey-row');
            if (rows.length > 1) button.closest('.admin-journey-row').remove();
          };
        });
      };

      addButton.addEventListener('click', () => {
        const row = document.createElement('div');
        row.className = 'admin-journey-row';
        row.innerHTML = '<div class="admin-journey-year"><label>Year</label><input name="journey_year[]" required maxlength="20" placeholder="2027" aria-label="Journey year"></div><div class="admin-journey-description"><label>Milestone description</label><textarea name="journey_text[]" required maxlength="2000" rows="3" placeholder="What happened during this year?" aria-label="Journey milestone text"></textarea></div><button type="button" class="admin-journey-remove" title="Remove milestone" aria-label="Remove milestone"><i class="fa-solid fa-xmark"></i></button>';
        list.appendChild(row);
        bindRemoveButtons();
        row.querySelector('input').focus();
      });
      bindRemoveButtons();
    });
  </script>
@endsection

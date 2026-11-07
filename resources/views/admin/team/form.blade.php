@extends('admin.layout')
@section('title', $teamMember->exists ? 'Edit team member' : 'Add team member')
@section('heading', $teamMember->exists ? 'Edit team member' : 'Add team member')
@section('content')
  <form class="admin-card admin-form" method="POST" enctype="multipart/form-data" action="{{ $teamMember->exists ? route('admin.team.update', $teamMember) : route('admin.team.store') }}">
    @csrf
    @if($teamMember->exists) @method('PUT') @endif
    <div class="admin-form-grid">
      <div class="admin-field"><label for="name">Full name *</label><input id="name" name="name" data-auto-slug-name="#slug" value="{{ old('name', $teamMember->name) }}" required maxlength="120"></div>
      <div class="admin-field"><label for="role">Job title / role *</label><input id="role" name="role" value="{{ old('role', $teamMember->role) }}" required maxlength="120" placeholder="e.g. Lead Software Engineer"></div>
      <div class="admin-field"><label for="slug">Profile URL slug</label><input id="slug" name="slug" value="{{ old('slug', $teamMember->slug) }}" maxlength="150" placeholder="Auto-generated from name if blank"><small>Letters, numbers, dashes, and underscores only.</small></div>
      <div class="admin-field"><label for="sort_order">Display order</label><input id="sort_order" name="sort_order" type="number" min="0" max="65535" value="{{ old('sort_order', $teamMember->sort_order ?? 0) }}" required></div>
      <div class="admin-field full"><label for="short_bio">Short introduction *</label><textarea id="short_bio" name="short_bio" required maxlength="300" rows="3">{{ old('short_bio', $teamMember->short_bio) }}</textarea><small>Shown on the team directory card.</small></div>
      <div class="admin-field full"><label for="biography">Full profile / biography</label><textarea id="biography" name="biography" maxlength="5000" rows="6">{{ old('biography', $teamMember->biography) }}</textarea></div>
      <div class="admin-field"><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email', $teamMember->email) }}" maxlength="254"></div>
      <div class="admin-field"><label for="phone">Phone</label><input id="phone" name="phone" value="{{ old('phone', $teamMember->phone) }}" maxlength="40"></div>
      <div class="admin-field"><label for="location">Location</label><input id="location" name="location" value="{{ old('location', $teamMember->location) }}" maxlength="120" placeholder="e.g. Cumilla, Bangladesh"></div>
      <div class="admin-field"><label for="linkedin_url">LinkedIn URL</label><input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url', $teamMember->linkedin_url) }}" maxlength="255" placeholder="https://..."></div>
      <div class="admin-field"><label for="github_url">GitHub URL</label><input id="github_url" name="github_url" type="url" value="{{ old('github_url', $teamMember->github_url) }}" maxlength="255" placeholder="https://..."></div>
      <div class="admin-field"><label for="facebook_url">Facebook URL</label><input id="facebook_url" name="facebook_url" type="url" value="{{ old('facebook_url', $teamMember->facebook_url) }}" maxlength="255" placeholder="https://facebook.com/..."></div>
      <div class="admin-field"><label for="website_url">Personal website</label><input id="website_url" name="website_url" type="url" value="{{ old('website_url', $teamMember->website_url) }}" maxlength="255" placeholder="https://..."></div>
      <div class="admin-field full"><label for="skills">Skills &amp; expertise</label><textarea id="skills" name="skills" maxlength="2000" rows="3" placeholder="Laravel, PHP, MySQL, Git&#10;Custom Skill|fa-solid fa-lightbulb">{{ old('skills', $teamMember->skills) }}</textarea><small>Enter skills separated by commas or new lines. Known skills get icons automatically. Use <strong>Skill Name|icon-class</strong> for a custom Font Awesome icon.</small></div>
      <div class="admin-field full"><label for="experience">Work experience</label><textarea id="experience" name="experience" maxlength="5000" rows="5">{{ old('experience', $teamMember->experience) }}</textarea></div>
      <div class="admin-field full"><label for="education">Education</label><textarea id="education" name="education" maxlength="5000" rows="4">{{ old('education', $teamMember->education) }}</textarea></div>
      <div class="admin-field"><label for="certifications">Certifications</label><textarea id="certifications" name="certifications" maxlength="2000" rows="3">{{ old('certifications', $teamMember->certifications) }}</textarea></div>
      <div class="admin-field"><label for="languages">Languages</label><textarea id="languages" name="languages" maxlength="1000" rows="3">{{ old('languages', $teamMember->languages) }}</textarea></div>
      <div class="admin-field"><label>Profile photo</label>
        <div class="admin-upload-box" data-admin-upload data-preview-type="image">
          <input id="profile_photo" name="profile_photo" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
          <label class="admin-upload-drop" for="profile_photo"><span class="admin-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span><strong>Choose a profile photo</strong><small>JPG, PNG or WebP · up to 4 MB</small></label>
          <div class="admin-upload-preview {{ $teamMember->profile_photo_path ? '' : 'is-empty' }}">
            @if($teamMember->profile_photo_path)<button class="admin-upload-remove" type="button" aria-label="Remove profile photo"><i class="fa-solid fa-xmark"></i></button><img src="{{ route('team.photo', ['path' => $teamMember->profile_photo_path]) }}" alt="Current profile photo">@endif
          </div>
          <input type="hidden" name="remove_profile_photo" value="0">
        </div>
      </div>
      <div class="admin-field"><label>CV (PDF)</label>
        <div class="admin-upload-box" data-admin-upload data-preview-type="file">
          <input id="cv_file" name="cv_file" type="file" accept=".pdf,application/pdf">
          <label class="admin-upload-drop" for="cv_file"><span class="admin-upload-icon"><i class="fa-solid fa-file-arrow-up"></i></span><strong>Choose a CV file</strong><small>PDF only · up to 10 MB</small></label>
          <div class="admin-upload-preview admin-file-preview {{ $teamMember->cv_file_path ? '' : 'is-empty' }}">
            @if($teamMember->cv_file_path)<button class="admin-upload-remove" type="button" aria-label="Remove CV"><i class="fa-solid fa-xmark"></i></button><i class="fa-solid fa-file-pdf"></i><strong>Current CV.pdf</strong>@endif
          </div>
          <input type="hidden" name="remove_cv_file" value="0">
        </div>
      </div>
    </div>
    <input type="hidden" name="is_active" value="0">
    <label class="admin-checkbox"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $teamMember->exists ? $teamMember->is_active : true))> Published on the website</label>
    <div class="admin-form-actions"><button class="admin-button" type="submit">{{ $teamMember->exists ? 'Save changes' : 'Create profile' }}</button><a class="admin-button secondary" href="{{ route('admin.team.index') }}">Cancel</a></div>
  </form>
@endsection

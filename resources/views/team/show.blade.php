@extends('layouts.site')
@section('title', $teamMember->name.' | '.$siteSettings['site_name'])
@section('meta_description', $teamMember->short_bio)
@section('content')
  @php
    $skills = array_filter(preg_split('/[\r\n,]+/', $teamMember->skills ?? '') ?: []);
    $skillIconMap = [
      'laravel' => 'fa-brands fa-laravel',
      'php' => 'fa-brands fa-php',
      'mysql' => 'fa-solid fa-database',
      'sql' => 'fa-solid fa-database',
      'api development' => 'fa-solid fa-code',
      'api' => 'fa-solid fa-code',
      'git' => 'fa-brands fa-git-alt',
      'github' => 'fa-brands fa-github',
      'javascript' => 'fa-brands fa-js',
      'js' => 'fa-brands fa-js',
      'react' => 'fa-brands fa-react',
      'next.js' => 'fa-brands fa-react',
      'nextjs' => 'fa-brands fa-react',
      'vue' => 'fa-brands fa-vuejs',
      'angular' => 'fa-brands fa-angular',
      'node.js' => 'fa-brands fa-node-js',
      'nodejs' => 'fa-brands fa-node-js',
      'python' => 'fa-brands fa-python',
      'java' => 'fa-brands fa-java',
      'html' => 'fa-brands fa-html5',
      'css' => 'fa-brands fa-css3-alt',
      'bootstrap' => 'fa-brands fa-bootstrap',
      'wordpress' => 'fa-brands fa-wordpress',
      'docker' => 'fa-brands fa-docker',
      'aws' => 'fa-brands fa-aws',
      'linux' => 'fa-brands fa-linux',
      'figma' => 'fa-brands fa-figma',
      'facebook' => 'fa-brands fa-facebook-f',
      'linkedin' => 'fa-brands fa-linkedin-in',
      'google ads' => 'fa-brands fa-google',
      'seo' => 'fa-solid fa-magnifying-glass-chart',
      'digital marketing' => 'fa-solid fa-bullhorn',
      'mongodb' => 'fa-solid fa-leaf',
      'mongodb atlas' => 'fa-solid fa-cloud',
    ];
    $socialLinks = [
      'linkedin_url' => ['label' => 'LinkedIn', 'icon' => 'fa-brands fa-linkedin-in'],
      'github_url' => ['label' => 'GitHub', 'icon' => 'fa-brands fa-github'],
      'facebook_url' => ['label' => 'Facebook', 'icon' => 'fa-brands fa-facebook-f'],
      'website_url' => ['label' => 'Website', 'icon' => 'fa-solid fa-globe'],
    ];
  @endphp
  <section class="section team-profile-section">
    <div class="container">
      <a class="team-back-link reveal" href="{{ route('team.index') }}"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to our team</a>
      <div class="team-profile-hero reveal">
        <div class="team-profile-photo">
          @if($teamMember->profile_photo_path)
            <img src="{{ route('team.photo', ['path' => $teamMember->profile_photo_path]) }}" alt="{{ $teamMember->name }}">
          @else
            <span class="team-photo-placeholder"><i class="fa-regular fa-user" aria-hidden="true"></i></span>
          @endif
        </div>
        <div class="team-profile-intro">
          <span class="section-kicker">DOTiT TEAM MEMBER</span>
          <h1>{{ $teamMember->name }}</h1>
          <p class="team-profile-role">{{ $teamMember->role }}</p>
          <p class="team-profile-summary">{{ $teamMember->short_bio }}</p>
          <div class="team-profile-connect">
            <span class="team-connect-label">LET'S CONNECT</span>
            @if($teamMember->email)
              <a class="team-email-box" href="mailto:{{ $teamMember->email }}">
                <span><i class="fa-regular fa-envelope" aria-hidden="true"></i></span>
                <span><small>MAIL</small><strong>{{ $teamMember->email }}</strong></span>
                <i class="fa-solid fa-arrow-right team-email-arrow" aria-hidden="true"></i>
              </a>
            @else
              <div class="team-email-box team-email-empty">
                <span><i class="fa-regular fa-envelope" aria-hidden="true"></i></span>
                <span><small>MAIL</small><strong>Contact details coming soon</strong></span>
              </div>
            @endif
          </div>
          <div class="team-profile-actions">
            @if($teamMember->cv_file_path)
              <a class="btn btn-primary" href="{{ route('team.file', ['path' => $teamMember->cv_file_path]) }}" download><i class="fa-solid fa-file-arrow-down" aria-hidden="true"></i> Download CV</a>
            @endif
          </div>
          <div class="team-contact-meta">
            @if($teamMember->location)<span><i class="fa-solid fa-location-dot" aria-hidden="true"></i> {{ $teamMember->location }}</span>@endif
            @if($teamMember->phone)<a href="tel:{{ $teamMember->phone }}"><i class="fa-solid fa-phone" aria-hidden="true"></i> {{ $teamMember->phone }}</a>@endif
          </div>
          <div class="team-social-links">
            @foreach($socialLinks as $field => $social)
              @if($teamMember->{$field})
                <a href="{{ $teamMember->{$field} }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}"><i class="{{ $social['icon'] }}" aria-hidden="true"></i><span>{{ $social['label'] }}</span></a>
              @endif
            @endforeach
          </div>
        </div>
      </div>

      <div class="team-profile-content">
        @if($teamMember->biography)
          <section class="team-resume-card team-biography reveal">
            <span class="section-kicker">PROFILE</span>
            <h2>About {{ $teamMember->name }}</h2>
            <div class="team-prose">{!! nl2br(e($teamMember->biography)) !!}</div>
          </section>
        @endif
        @if($skills)
          <section class="team-resume-card reveal">
            <span class="section-kicker">CORE EXPERTISE</span>
            <h2>Skills &amp; expertise</h2>
            <div class="team-skill-list team-skill-list-large">
              @foreach($skills as $skill)
                @php
                  $skillParts = array_map('trim', explode('|', trim($skill), 2));
                  $skillName = $skillParts[0] ?: trim($skill);
                  $skillKey = mb_strtolower($skillName);
                  $skillIcon = $skillParts[1] ?? ($skillIconMap[$skillKey] ?? 'fa-solid fa-code');
                  if (!preg_match('/^(fa-(?:brands|solid|regular) fa-[a-z0-9-]+)(?: fa-[a-z0-9-]+)*$/i', $skillIcon)) {
                    $skillIcon = 'fa-solid fa-code';
                  }
                @endphp
                <span><i class="{{ $skillIcon }}" aria-hidden="true"></i>{{ $skillName }}</span>
              @endforeach
            </div>
          </section>
        @endif
        <div class="team-resume-grid">
          @foreach([
            'experience' => ['Experience', 'fa-solid fa-briefcase'],
            'education' => ['Education', 'fa-solid fa-graduation-cap'],
            'certifications' => ['Certifications', 'fa-solid fa-certificate'],
            'languages' => ['Languages', 'fa-solid fa-language'],
          ] as $field => [$heading, $icon])
            @if($teamMember->{$field})
              <section class="team-resume-card reveal">
                <span class="team-resume-icon"><i class="{{ $icon }}" aria-hidden="true"></i></span>
                <h2>{{ $heading }}</h2>
                <div class="team-prose">{!! nl2br(e($teamMember->{$field})) !!}</div>
              </section>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection

@extends('layouts.site')
@section('title', 'Our Team | '.$siteSettings['site_name'])
@section('meta_description', 'Meet the people behind '.$siteSettings['site_name'].' and explore their profiles, experience, skills, and CVs.')
@section('content')
  <section class="section team-page-section">
    <div class="container">
      <div class="section-heading centered reveal">
        <div class="section-kicker">THE PEOPLE BEHIND DOTiT</div>
        <h1>Meet our <span>team</span></h1>
        <p>Get to know the people who design, develop, and digitalize better ideas into real-world solutions.</p>
      </div>

      @if($teamMembers->isEmpty())
        <div class="team-empty reveal">
          <span><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
          <h2>Our team profiles are coming soon</h2>
          <p>We are preparing the profiles. Please check back soon.</p>
        </div>
      @else
        <div class="team-grid">
          @foreach($teamMembers as $teamMember)
            <article class="team-card reveal">
              <a class="team-card-photo" href="{{ route('team.show', $teamMember) }}" aria-label="View {{ $teamMember->name }}'s profile">
                @if($teamMember->profile_photo_path)
                  <img src="{{ route('team.photo', ['path' => $teamMember->profile_photo_path]) }}" alt="{{ $teamMember->name }}" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='grid';">
                  <span class="team-photo-placeholder" style="display:none"><i class="fa-regular fa-user" aria-hidden="true"></i></span>
                @else
                  <span class="team-photo-placeholder"><i class="fa-regular fa-user" aria-hidden="true"></i></span>
                @endif
                <span class="team-card-photo-mark"><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></span>
              </a>
              <div class="team-card-content">
                <h2><a href="{{ route('team.show', $teamMember) }}">{{ $teamMember->name }}</a></h2>
                <span class="team-role">{{ $teamMember->role }}</span>
                <a class="team-profile-link" href="{{ route('team.show', $teamMember) }}">View full profile <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>
@endsection

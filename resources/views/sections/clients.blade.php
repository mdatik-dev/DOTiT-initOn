@if(($clients ?? collect())->isNotEmpty())
  <section class="client-marquee" aria-label="Companies we work with">
    <div class="client-marquee-heading">
      <span>Trusted by growing organizations</span>
    </div>
    <div class="client-marquee-viewport">
      <div class="client-marquee-track">
        @foreach([$clients, $clients] as $copy)
          @foreach($copy as $client)
            @if($client->website_url)
              <a class="client-logo-card" href="{{ $client->website_url }}" target="_blank" rel="noopener" aria-label="{{ $client->name }}">
            @else
              <div class="client-logo-card" aria-label="{{ $client->name }}">
            @endif
              @if($client->logo_path)
                <img src="{{ asset('storage/'.$client->logo_path) }}" alt="{{ $client->name }}">
              @else
                <span class="client-logo-mark"><i class="fa-solid fa-building"></i></span>
              @endif
              <strong>{{ $client->name }}</strong>
            @if($client->website_url)</a>@else</div>@endif
          @endforeach
        @endforeach
      </div>
    </div>
  </section>
@endif

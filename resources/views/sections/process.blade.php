<section class="section process {{ $currentPage === 'process' ? 'process-page' : '' }}" id="process">
  <div class="container">
    <div class="section-heading centered reveal">
      <div class="section-kicker">04 / HOW WE WORK</div>
      <h2>A clear path from <span>idea to impact.</span></h2>
      <p>From the first conversation to launch, every stage stays transparent, focused and connected.</p>
    </div>
    <div class="process-grid process-grid-detailed">
      <article class="process-step reveal">
        <div class="process-step-icon"><span>01</span><i class="fa-solid fa-comments" aria-hidden="true"></i></div>
        <h3>Requirement<br>Discussion</h3>
        <p>We discuss the client's idea, business goals, target audience, required features, budget direction, and expected outcome.</p>
      </article>
      <article class="process-step reveal">
        <div class="process-step-icon"><span>02</span><i class="fa-solid fa-list-check" aria-hidden="true"></i></div>
        <h3>Planning &amp;<br>Strategy</h3>
        <p>We create the sitemap, feature list, module plan, technology direction, timeline, and project roadmap.</p>
      </article>
      <article class="process-step reveal">
        <div class="process-step-icon"><span>03</span><i class="fa-solid fa-pencil-ruler" aria-hidden="true"></i></div>
        <h3>UI/UX Design &amp;<br>Prototype</h3>
        <p>We design clean user interfaces, user flows, wireframes, and interactive prototypes for client review.</p>
      </article>
      <article class="process-step reveal">
        <div class="process-step-icon"><span>04</span><i class="fa-solid fa-code" aria-hidden="true"></i></div>
        <h3>Development &amp;<br>Production</h3>
        <p>We develop the frontend, backend, database, API integrations, admin panel, and required project features.</p>
      </article>
      <article class="process-step reveal">
        <div class="process-step-icon"><span>05</span><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></div>
        <h3>Testing &amp;<br>Review</h3>
        <p>We test responsiveness, speed, security, bugs, admin features, and collect client feedback before launch.</p>
      </article>
      <article class="process-step reveal">
        <div class="process-step-icon"><span>06</span><i class="fa-solid fa-rocket" aria-hidden="true"></i></div>
        <h3>Delivery &amp;<br>Support</h3>
        <p>We deploy the project, provide admin training, documentation, maintenance, and future support.</p>
      </article>
    </div>

    @if($currentPage === 'process')
      <div class="process-principles reveal">
        <article><span><i class="fa-solid fa-diagram-project"></i></span><div><small>01 / COLLABORATION</small><h3>Built with your team</h3><p>Clear communication keeps decisions, feedback and priorities aligned throughout the project.</p></div></article>
        <article><span><i class="fa-solid fa-magnifying-glass-chart"></i></span><div><small>02 / QUALITY</small><h3>Tested before delivery</h3><p>Every important interaction is reviewed across usability, performance and real-world conditions.</p></div></article>
        <article><span><i class="fa-solid fa-arrow-trend-up"></i></span><div><small>03 / PROGRESS</small><h3>Designed for growth</h3><p>We create scalable foundations that can evolve with your users, business and future technology.</p></div></article>
      </div>

      <div class="growth-processes">
        <div class="growth-process-heading reveal">
          <div>
            <div class="section-kicker">05 / GROWTH PARTNERSHIP</div>
            <h2>Built by DOTiT.<br><span>Amplified by initOn.</span></h2>
          </div>
          <p>From technology planning to market growth, our two teams work through a connected process that turns strategy into measurable results.</p>
        </div>

        <div class="growth-process-grid">
          <article class="growth-process-card reveal">
            <div class="growth-process-card-head">
              <div class="growth-process-brand"><span>01</span><strong>initOn</strong></div>
              <i class="fa-solid fa-bullhorn" aria-hidden="true"></i>
            </div>
            <h3>Digital Marketing Process</h3>
            <p class="growth-process-intro">A focused campaign workflow built for reach, engagement and conversions.</p>
            <div class="growth-process-list">
              <div><span>01</span><i class="fa-solid fa-magnifying-glass"></i><h4>Research &amp; Audience</h4><p>Understand the market, audience behavior, competitors and campaign goals.</p></div>
              <div><span>02</span><i class="fa-solid fa-bullseye"></i><h4>Campaign Strategy</h4><p>Define platforms, targeting, content direction, budget and key performance goals.</p></div>
              <div><span>03</span><i class="fa-solid fa-palette"></i><h4>Creative Production</h4><p>Create brand-aligned posts, videos, ads, landing pages and promotional materials.</p></div>
              <div><span>04</span><i class="fa-solid fa-paper-plane"></i><h4>Launch &amp; Management</h4><p>Run campaigns, manage channels and deliver content consistently across platforms.</p></div>
              <div><span>05</span><i class="fa-solid fa-chart-line"></i><h4>Measure &amp; Optimize</h4><p>Track performance, improve targeting and scale the campaigns that generate results.</p></div>
            </div>
          </article>

          <article class="growth-process-card growth-process-card-dark reveal">
            <div class="growth-process-card-head">
              <div class="growth-process-brand"><span>02</span><strong>DOTiT</strong></div>
              <i class="fa-solid fa-code" aria-hidden="true"></i>
            </div>
            <h3>Technology Delivery Process</h3>
            <p class="growth-process-intro">A structured digital product workflow aligned with your business operations.</p>
            <div class="growth-process-list">
              <div><span>01</span><i class="fa-solid fa-comments"></i><h4>Discovery</h4><p>Capture business requirements, user needs, technical scope and success measures.</p></div>
              <div><span>02</span><i class="fa-solid fa-layer-group"></i><h4>Solution Planning</h4><p>Shape the architecture, roadmap, feature set and delivery milestones.</p></div>
              <div><span>03</span><i class="fa-solid fa-wand-magic-sparkles"></i><h4>Design &amp; Build</h4><p>Turn approved strategy into polished interfaces, systems and reliable features.</p></div>
              <div><span>04</span><i class="fa-solid fa-shield-halved"></i><h4>QA &amp; Launch</h4><p>Test the complete experience, deploy safely and prepare the team for operation.</p></div>
              <div><span>05</span><i class="fa-solid fa-headset"></i><h4>Support &amp; Growth</h4><p>Monitor, maintain and expand the product as the business continues to evolve.</p></div>
            </div>
          </article>
        </div>
      </div>
    @endif
  </div>
</section>

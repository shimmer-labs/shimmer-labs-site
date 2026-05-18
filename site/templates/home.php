<?php snippet('header') ?>

<!-- Event Banner -->
<a href="<?= url('office-hours') ?>" class="event-banner" id="eventBanner">
  <div class="container">
    <span class="event-banner__text">
      <strong>Free AI Office Hours</strong>, Tuesdays &amp; Thursdays, 2–4 PM at WorkIT Stillwater
    </span>
    <span class="event-banner__cta">Drop In →</span>
  </div>
</a>

<!-- Hero: Problem-statement -->
<section class="home-hero">
  <div class="container">
    <div class="home-hero__inner">
      <div class="home-hero__pain">
        <p>You didn't start your business to answer emails at midnight.</p>
        <p>Most small business owners lose 15+ hours a week to admin that has nothing to do with the work they love.</p>
      </div>
      <h1 class="home-hero__headline">We build custom software for small businesses.</h1>
      <p class="home-hero__tagline">You drive. We build the sidecar.</p>
      <div class="home-hero__ctas">
        <a href="<?= url('case-studies') ?>" class="btn btn--cta">See the Work</a>
        <a href="<?= url('contact') ?>" class="btn btn--secondary home-hero__btn-secondary">Book a Call</a>
      </div>
      <p class="home-hero__trust">No pitch. No pressure. Just a 30-minute conversation.</p>
    </div>
  </div>
</section>

<!-- Social Proof -->
<?php snippet('social-proof', ['clients' => $page->clients()]) ?>

<!-- Build Section -->
<section id="build" class="build-section">
  <div class="container">
    <div class="build-section__header">
      <h2 class="build-section__title">What We Build</h2>
      <p class="build-section__subtitle">AI agents, custom apps, and API integrations, built fast by a small team, not an agency.</p>
    </div>
    <div class="build-section__grid">
      <a href="/services/sidecar" class="build-card">
        <div class="build-card__icon"><img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" style="width: 48px; height: 48px; display: block;"></div>
        <h3 class="build-card__title">Sidecar (AI Agents)</h3>
        <p class="build-card__description">Narrow AI-assisted workflows that handle one job each. Live for Sweat Yoga and Supabase. Live in a week, autonomous in a month.</p>
        <span class="build-card__price">From $1,000/mo + implementation from $1,000</span>
        <span class="build-card__arrow">View Details →</span>
      </a>
      <a href="/services/custom-apps" class="build-card">
        <div class="build-card__icon">⚡</div>
        <h3 class="build-card__title">Custom Apps</h3>
        <p class="build-card__description">Web apps and iOS apps, from wireframes to launched product. TreeBidPro shipped in 2 weeks, Paidly in 6.</p>
        <span class="build-card__price">Web from $15k · iOS from $20k</span>
        <span class="build-card__arrow">View Details →</span>
      </a>
      <a href="/services/api-integrations" class="build-card">
        <div class="build-card__icon">🔌</div>
        <h3 class="build-card__title">API Integrations</h3>
        <p class="build-card__description">Your software doesn't talk to each other? We build the connections. Taddy live on n8n, Zapier, and Make.com.</p>
        <span class="build-card__price">$2,500 – $7,000 per integration</span>
        <span class="build-card__arrow">View Details →</span>
      </a>
    </div>
  </div>
</section>

<!-- Thesis: The technology works. Nobody designed the system. -->
<?php snippet('comparison-table') ?>

<!-- Hook Questions: What's in your sidecar? -->
<?php snippet('hook-questions') ?>

<!-- Tools Carousel -->
<?php snippet('tools-carousel') ?>

<!-- Supabase proof: Sarah Gold -->
<?php snippet('supabase-story') ?>

<!-- How this actually works (sidecar metaphor + client stories) -->
<?php snippet('process-section') ?>

<!-- Featured Case Study -->
<?php if ($page->featuredCaseStudy()->isNotEmpty()): ?>
  <?php snippet('case-study-card', ['case' => $page->featuredCaseStudy()->toPage()]) ?>
<?php endif ?>

<!-- Engagement Process -->
<?php snippet('engagement-process') ?>

<!-- Case Studies -->
<?php if ($caseStudiesPage = page('case-studies')): ?>
<section class="projects">
  <div class="container">
    <h2 class="projects__title">Recent Case Studies</h2>
    <div class="projects__grid">
      <?php
      // Explicit slug list so the homepage can feature a different trio
      // than the /case-studies index top row.
      $homeFeatured = ['sweat-yoga-fitness', 'taddy-api-integrations', 'paidly'];
      foreach ($homeFeatured as $slug):
        if ($item = $caseStudiesPage->find($slug)):
      ?>
        <?php snippet('project-card', ['project' => $item]) ?>
      <?php
        endif;
      endforeach
      ?>
    </div>
    <div class="projects__see-all">
      <a href="<?= $caseStudiesPage->url() ?>" class="btn btn--secondary">See all case studies →</a>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Final CTA -->
<section class="cta-final">
  <div class="container">
    <div class="cta-final__content">
      <h2><?= $page->finalCtaTitle()->or("Got a Problem? Let's Build the Fix.") ?></h2>
      <?php if ($page->finalCtaDescription()->isNotEmpty()): ?>
        <p><?= $page->finalCtaDescription() ?></p>
      <?php endif ?>
      <a href="<?= $page->finalCtaUrl() ?>" class="btn btn--cta">
        <?= $page->finalCtaText()->or('Get Started') ?>
      </a>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
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
    <div class="home-hero__inner home-hero__inner--with-photo">
      <div class="home-hero__copy">
        <div class="home-hero__pain">
          <p>You didn't start your business to answer emails at midnight.</p>
          <p>Most small business owners lose 15+ hours a week to admin that has nothing to do with the work they love.</p>
        </div>
        <h1 class="home-hero__headline">We build custom software for small businesses.</h1>
        <p class="home-hero__tagline">You drive. We build the sidecar.</p>
        <p class="home-hero__credential">Built by a systems engineer with two decades across <a href="<?= url('about') ?>">National Instruments, Iterable, WeaveGrid, and Sense</a> — making complex systems behave, before AI was the hammer.</p>
        <div class="home-hero__ctas">
          <a href="<?= url('case-studies') ?>" class="btn btn--cta">See the Work</a>
          <a href="<?= url('contact') ?>" class="btn btn--secondary home-hero__btn-secondary">Book a Call</a>
        </div>
        <p class="home-hero__trust">No pitch. No pressure. Just a 30-minute conversation.</p>
      </div>
      <div class="home-hero__photo">
        <img src="<?= url('assets/images/logan-presenting.jpg') ?>" alt="Logan Shimmer teaching an AI workshop at Meridian Technology Center in Stillwater">
        <span class="home-hero__photo-caption">Teaching "AI for the Boring Parts of Your Business" at Meridian Technology Center in Stillwater</span>
      </div>
    </div>
  </div>
</section>

<!-- Social Proof -->
<?php snippet('social-proof', ['clients' => $page->clients()]) ?>

<!-- Build Section: the engagement ladder -->
<section id="build" class="build-section">
  <div class="container">
    <div class="build-section__header">
      <h2 class="build-section__title">Three Ways to Work With Us</h2>
      <p class="build-section__subtitle">Start free, learn with a partner, or hand it off entirely. Every rung is a small yes.</p>
    </div>
    <div class="build-section__grid">
      <a href="/office-hours" class="build-card">
        <div class="build-card__icon">☕</div>
        <h3 class="build-card__title">Start Free</h3>
        <p class="build-card__description">Walk into AI Office Hours at WorkIT, Tuesdays and Thursdays. Or join Main Street AI, our free community for local business owners. Bring your weirdest question.</p>
        <span class="build-card__price">Free. Genuinely.</span>
        <span class="build-card__arrow">Come Say Hi →</span>
      </a>
      <a href="/services/concierge" class="build-card">
        <div class="build-card__icon">🤝</div>
        <h3 class="build-card__title">AI Concierge</h3>
        <p class="build-card__description">Done WITH you. Two working sessions a month, text us when you're stuck, and every automation built on your screen so you own it and understand it.</p>
        <span class="build-card__price">$1,000/mo · first 5 clients: $750/mo</span>
        <span class="build-card__arrow">View Details →</span>
      </a>
      <a href="/services/sidecar" class="build-card">
        <div class="build-card__icon"><img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" style="width: 48px; height: 48px; display: block;"></div>
        <h3 class="build-card__title">Sidecar</h3>
        <p class="build-card__description">Done FOR you. We build the automation, run it, and maintain it while you stay in the driver's seat. Live for Sweat Yoga and a Stillwater landscaper.</p>
        <span class="build-card__price">Scoped to your build, sized to fit</span>
        <span class="build-card__arrow">View Details →</span>
      </a>
    </div>
    <p class="build-section__more">Also in the shop: <a href="/services/custom-apps">custom web and iOS apps</a> and <a href="/services/api-integrations">API integrations</a>, for when the fix is a product, not a process.</p>
  </div>
</section>

<!-- The Walkthrough: front-door offer -->
<?php snippet('walkthrough-cta') ?>

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
      $homeFeatured = ['sweat-yoga-fitness', 'stillwater-landscaper', 'taddy-api-integrations'];
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
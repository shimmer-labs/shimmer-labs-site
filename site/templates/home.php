<?php snippet('header') ?>

<!-- Event Banner -->
<a href="<?= url('office-hours') ?>" class="event-banner" id="eventBanner">
  <div class="container">
    <span class="event-banner__text">
      <strong>Free AI Office Hours</strong> — Tuesdays &amp; Thursdays, 2–4 PM at WorkIT Stillwater
    </span>
    <span class="event-banner__cta">Drop In →</span>
  </div>
</a>

<!-- Hero: Scanner-First -->
<section class="hero" id="scanner">
  <div class="container">
    <div class="hero__scanner">
      <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" class="hero__scanner-logo">
      <h1 class="hero__title">Too many hats? See which ones you can take off.</h1>
      <p class="hero__description">Enter your website. We'll show you what to automate first.</p>

      <form class="scanner-form" id="scannerForm" action="#" method="POST" novalidate>
        <div class="scanner-form__input-group">
          <input
            type="text"
            name="url"
            id="scannerUrl"
            class="scanner-form__input"
            placeholder="yourwebsite.com"
            required
            inputmode="url"
            autocomplete="off"
            enterkeyhint="go"
          >
          <button type="submit" class="btn btn--sidecar scanner-form__button">Scan My Business</button>
        </div>
        <p class="scanner-form__note">Free. Takes 15 seconds. No signup required.</p>
      </form>

      <div class="scanner-form__loading" id="scannerLoading" style="display: none;">
        <div class="scanner-form__progress-bar"><div class="scanner-form__progress-fill" id="scannerProgressFill"></div></div>
        <p class="scanner-form__loading-text" id="scannerLoadingText">Reading your website...</p>
      </div>

      <p class="scanner-form__error" id="scannerError" style="display: none;"></p>

    </div>
  </div>
</section>

<!-- Social Proof -->
<?php snippet('social-proof', ['clients' => $page->clients()]) ?>

<!-- How It Works (Scanner) -->
<section class="scanner-how-it-works">
  <div class="container">
    <h2 class="scanner-how-it-works__title">How the scan works</h2>
    <div class="scanner-how-it-works__steps">
      <div class="scanner-how-it-works__step">
        <span class="scanner-how-it-works__number">1</span>
        <p>Enter your website URL</p>
      </div>
      <div class="scanner-how-it-works__step">
        <span class="scanner-how-it-works__number">2</span>
        <p>We read your site and identify opportunities</p>
      </div>
      <div class="scanner-how-it-works__step">
        <span class="scanner-how-it-works__number">3</span>
        <p>You get a custom hiring plan — 3 agents ready to work</p>
      </div>
    </div>
    <div class="scanner-how-it-works__cta">
      <a href="#scanner" class="btn btn--sidecar">Scan My Business</a>
      <span style="margin: 0 1rem; color: var(--color-gray-medium);">or</span>
      <a href="/services/sidecar" class="btn btn--primary">Learn More About Sidecar</a>
    </div>
  </div>
</section>

<!-- Build Section -->
<section id="build" class="build-section">
  <div class="container">
    <div class="build-section__header">
      <h2 class="build-section__title">We Also Build Custom Software</h2>
      <p class="build-section__subtitle">Web apps, iOS apps, and API integrations — built fast by a small team, not an agency.</p>
    </div>
    <div class="build-section__grid">
      <a href="/services/custom-apps" class="build-card">
        <div class="build-card__icon">⚡</div>
        <h3 class="build-card__title">Custom Apps</h3>
        <p class="build-card__description">Web apps and iOS apps — from wireframes to launched product. Built TreeBidPro in 2 weeks, Paidly in 6.</p>
        <span class="build-card__price">Web apps from $25k · iOS from $35k</span>
        <span class="build-card__arrow">View Details →</span>
      </a>
      <a href="/services/api-integrations" class="build-card">
        <div class="build-card__icon">🔌</div>
        <h3 class="build-card__title">API Integrations</h3>
        <p class="build-card__description">Your software doesn't talk to each other? We build the connections. Clean APIs, proper docs, no janky workarounds.</p>
        <span class="build-card__price">$3.5k - $12k</span>
        <span class="build-card__arrow">View Details →</span>
      </a>
    </div>
  </div>
</section>

<!-- Comparison Table: You vs Agencies -->
<?php snippet('comparison-table') ?>

<!-- Tools Carousel (moved from earlier) -->
<?php snippet('tools-carousel') ?>

<!-- Process Section -->
<?php snippet('process-section') ?>

<!-- Featured Case Study -->
<?php if ($page->featuredCaseStudy()->isNotEmpty()): ?>
  <?php snippet('case-study-card', ['case' => $page->featuredCaseStudy()->toPage()]) ?>
<?php endif ?>

<!-- Testimonials -->
<?php snippet('testimonials-section', ['testimonials' => $page->testimonials()]) ?>

<!-- Case Studies -->
<?php if ($caseStudiesPage = page('case-studies')): ?>
<section class="projects">
  <div class="container">
    <h2 class="projects__title">Recent Case Studies</h2>
    <div class="projects__grid">
      <?php foreach ($caseStudiesPage->children()->listed() as $item): ?>
        <?php snippet('project-card', ['project' => $item]) ?>
      <?php endforeach ?>
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
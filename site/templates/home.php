<?php snippet('header') ?>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <div class="hero__wrapper">
      <div class="hero__content">
        <?php if ($page->heroSubheading()->isNotEmpty()): ?>
          <p class="hero__subheading"><?= $page->heroSubheading() ?></p>
        <?php endif ?>
        
        <h1 class="hero__title"><?= $page->heroTitle()->or('We Build the Software Your Business Actually Needs') ?></h1>
        
        <?php if ($page->heroDescription()->isNotEmpty()): ?>
          <p class="hero__description"><?= $page->heroDescription() ?></p>
        <?php endif ?>
        
        <?php if ($page->heroCta()->isNotEmpty()): ?>
          <a href="<?= $page->heroCtaUrl() ?>" class="btn btn--primary">
            <?= $page->heroCta() ?>
          </a>
        <?php endif ?>
      </div>
      
      <div class="hero__visual">
        <div class="laptop-mockup">
          <?php if ($page->heroLaptopImage()->toFile()): ?>
            <img src="<?= url('assets/images/n8n.jpg') ?>" alt="Custom app development" class="laptop-screen">
          <?php endif ?>
        </div>
        <?php if ($page->heroCircleImage()->toFile()): ?>
          <div class="hero__circle-image">
            <img src="<?= url('assets/images/hero.jpg') ?>" alt="Shimmer Labs projects">
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>

<!-- Sidecar Scanner -->
<section class="scanner-section" id="scanner">
  <div class="container">
    <div class="scanner-section__inner">
      <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" class="scanner-section__logo">
      <h2 class="scanner-section__title">Too many hats? See which ones you can take off.</h2>
      <p class="scanner-section__subtitle">Enter your website — we'll show you 2-3 AI agents custom-built for your business.</p>

      <form class="scanner-form" id="scannerForm" action="javascript:void(0)" method="POST" novalidate>
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
        <div class="scanner-form__spinner"></div>
        <p class="scanner-form__loading-text" id="scannerLoadingText">Reading your website...</p>
      </div>

      <p class="scanner-form__error" id="scannerError" style="display: none;"></p>
    </div>
  </div>
</section>

<!-- Social Proof -->
<?php snippet('social-proof', ['clients' => $page->clients()]) ?>

<!-- Sidecar Section -->
<section id="sidecar" class="sidecar-section">
  <div class="container">
    <div class="sidecar-section__inner">
      <div class="sidecar-section__brand">
        <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" class="sidecar-section__logo">
        <h2 class="sidecar-section__tagline">You drive. The boring stuff rides in the sidecar.</h2>
        <p class="sidecar-section__description">You started your business to do what you love — not to screen applicants, chase leads, and post on social media. Add an AI sidecar and get back to the work that matters.</p>
      </div>
      <div class="sidecar-section__details">
        <ul class="sidecar-section__benefits">
          <li>Screens job applicants</li>
          <li>Posts to social media</li>
          <li>Generates & follows up leads</li>
          <li>Drafts proposals</li>
          <li>Runs 24/7/365</li>
          <li>You stay in the driver's seat</li>
        </ul>
        <div class="sidecar-section__cta">
          <a href="/services/sidecar" class="btn btn--sidecar">Learn More</a>
          <a href="/contact" class="btn btn--secondary" style="margin-left: 1rem;">Book a Free Call</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Build Section -->
<section id="build" class="build-section">
  <div class="container">
    <div class="build-section__header">
      <h2 class="build-section__title">We Also Build Custom Software</h2>
      <p class="build-section__subtitle">Web apps, iOS apps, and API integrations — built fast by a developer, not an agency.</p>
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

<!-- Projects -->
<?php if ($projectsPage = page('projects')): ?>
<section class="projects">
  <div class="container">
    <h2 class="projects__title">Recent Projects</h2>
    <div class="projects__grid">
      <?php foreach ($projectsPage->children() as $project): ?>
        <?php snippet('project-card', ['project' => $project]) ?>
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
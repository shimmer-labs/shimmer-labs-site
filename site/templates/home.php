<?php snippet('header') ?>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <div class="hero__wrapper">
      <div class="hero__content">
        <?php if ($page->heroSubheading()->isNotEmpty()): ?>
          <p class="hero__subheading"><?= $page->heroSubheading() ?></p>
        <?php endif ?>
        
        <h1 class="hero__title"><?= $page->heroTitle()->or('Automate Your Business, Reclaim Your Time') ?></h1>
        
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
            <img src="<?= url('assets/images/n8n.jpg') ?>" alt="n8n workflow automation" class="laptop-screen">
          <?php endif ?>
        </div>
        <?php if ($page->heroCircleImage()->toFile()): ?>
          <div class="hero__circle-image">
            <img src="<?= url('assets/images/hero.jpg') ?>" alt="Automation in action">
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>

<!-- Social Proof -->
<?php snippet('social-proof', ['clients' => $page->clients()]) ?>

<!-- Packages & Pricing -->
<?php if ($page->packages()->isNotEmpty()): ?>
<section class="packages">
  <div class="container">
    <div class="packages__header">
      <?php if ($page->packagesTitle()->isNotEmpty()): ?>
        <h2 class="packages__title"><?= $page->packagesTitle() ?></h2>
      <?php endif ?>
      <?php if ($page->packagesSubtitle()->isNotEmpty()): ?>
        <p class="packages__subtitle"><?= $page->packagesSubtitle() ?></p>
      <?php endif ?>
    </div>

    <div class="packages__grid">
      <?php foreach ($page->packages()->toStructure() as $package): ?>
        <?php snippet('package-card', ['package' => $package]) ?>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

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
      <h2><?= $page->finalCtaTitle()->or("Let's Automate Your Business") ?></h2>
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
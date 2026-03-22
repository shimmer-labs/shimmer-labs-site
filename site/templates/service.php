<?php snippet('header') ?>

<?php $isSidecar = $page->slug() === 'sidecar'; ?>

<!-- Service Hero -->
<section class="service-hero<?= $isSidecar ? ' service-hero--sidecar' : '' ?>">
  <div class="container">
    <div class="service-hero__content">
      <?php if ($isSidecar): ?>
        <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" class="service-hero__logo">
      <?php elseif ($page->icon()->isNotEmpty()): ?>
        <div class="service-hero__icon"><?= $page->icon() ?></div>
      <?php endif ?>

      <h1 class="service-hero__title"><?= $page->title() ?></h1>

      <?php if ($page->summary()->isNotEmpty()): ?>
        <p class="service-hero__summary"><?= $page->summary() ?></p>
      <?php endif ?>

      <?php if ($page->priceRange()->isNotEmpty()): ?>
        <div class="service-hero__pricing">
          <span class="service-hero__price-label">Starting at</span>
          <span class="service-hero__price"><?= $page->priceRange() ?></span>
        </div>
      <?php endif ?>

      <div class="service-hero__cta">
        <a href="#contact-form" class="btn <?= $isSidecar ? 'btn--sidecar' : 'btn--primary' ?>">
          <?= $isSidecar ? 'Book a Free Discovery Call' : 'Get Started →' ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Description -->
<?php if ($page->text()->isNotEmpty()): ?>
<section class="service-description">
  <div class="container">
    <div class="service-description__content">
      <?= $page->text()->kt() ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Pricing Tiers -->
<?php if ($page->pricingTiers()->isNotEmpty()): ?>
<section class="service-pricing">
  <div class="container">
    <h2 class="service-pricing__title">Pricing & Packages</h2>
    <div class="service-pricing__grid">
      <?php foreach ($page->pricingTiers()->toStructure() as $tier): ?>
        <div class="pricing-tier<?= $tier->featured()->toBool() ? ' pricing-tier--featured' : '' ?>">
          <?php if ($tier->featured()->toBool()): ?>
            <div class="pricing-tier__badge">⭐ Most Popular</div>
          <?php endif ?>

          <h3 class="pricing-tier__name"><?= $tier->name() ?></h3>
          <div class="pricing-tier__price"><?= $tier->price() ?></div>

          <?php if ($tier->description()->isNotEmpty()): ?>
            <p class="pricing-tier__description"><?= $tier->description() ?></p>
          <?php endif ?>

          <?php if ($tier->features()->isNotEmpty()): ?>
            <ul class="pricing-tier__features">
              <?php
              $features = preg_split('/\r\n|\r|\n/', $tier->features()->value());
              foreach ($features as $feature):
                if (trim($feature)): ?>
                <li><?= trim($feature) ?></li>
              <?php endif; endforeach ?>
            </ul>
          <?php endif ?>

          <?php if ($tier->timeline()->isNotEmpty()): ?>
            <div class="pricing-tier__timeline">
              <strong>Timeline:</strong> <?= $tier->timeline() ?>
            </div>
          <?php endif ?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- What's Included -->
<?php if ($page->whatsIncluded()->isNotEmpty()): ?>
<section class="service-included">
  <div class="container">
    <h2 class="service-included__title">What's Included</h2>
    <div class="service-included__grid">
      <?php foreach ($page->whatsIncluded()->toStructure() as $item): ?>
        <div class="included-item">
          <?php if ($item->icon()->isNotEmpty()): ?>
            <div class="included-item__icon"><?= $item->icon() ?></div>
          <?php endif ?>
          <h3 class="included-item__title"><?= $item->title() ?></h3>
          <?php if ($item->description()->isNotEmpty()): ?>
            <p class="included-item__description"><?= $item->description() ?></p>
          <?php endif ?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Process/How It Works -->
<?php if ($page->process()->isNotEmpty()): ?>
<section class="service-process">
  <div class="container">
    <h2 class="service-process__title">How It Works</h2>
    <div class="service-process__steps">
      <?php $stepNumber = 1; ?>
      <?php foreach ($page->process()->toStructure() as $step): ?>
        <div class="process-step">
          <div class="process-step__number"><?= $stepNumber++ ?></div>
          <div class="process-step__content">
            <h3 class="process-step__title"><?= $step->title() ?></h3>
            <?php if ($step->description()->isNotEmpty()): ?>
              <p class="process-step__description"><?= $step->description() ?></p>
            <?php endif ?>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Tech Stack -->
<?php if ($page->techStack()->isNotEmpty()): ?>
<section class="service-tech">
  <div class="container">
    <h2 class="service-tech__title">Technology Stack</h2>
    <div class="service-tech__content">
      <p class="service-tech__intro"><?= $page->techStackIntro() ?></p>
      <div class="service-tech__tags">
        <?php foreach ($page->techStack()->split() as $tech): ?>
          <span class="tech-tag"><?= $tech ?></span>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Portfolio Examples -->
<?php
$portfolioPages = [];
if ($page->portfolioProjects()->isNotEmpty()) {
  try {
    $portfolioPages = $page->portfolioProjects()->toPages();
  } catch (TypeError $e) {
    $portfolioPages = [];
  }
}
?>
<?php if (count($portfolioPages) > 0): ?>
<section class="service-portfolio">
  <div class="container">
    <h2 class="service-portfolio__title">Work Examples</h2>
    <div class="service-portfolio__grid">
      <?php foreach ($portfolioPages as $project): ?>
        <?php if ($project): ?>
        <a href="<?= $project->url() ?>" class="portfolio-example">
          <?php if ($project->image()): ?>
            <img src="<?= $project->image()->url() ?>" alt="<?= $project->title() ?>">
          <?php endif ?>
          <h3><?= $project->title() ?></h3>
          <p><?= $project->summary()->excerpt(100) ?></p>
        </a>
        <?php endif ?>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Contact Form -->
<div id="contact-form" class="<?= $isSidecar ? 'service-form--sidecar' : '' ?>">
  <?php snippet('service-contact-form', [
    'ctaTitle' => $page->ctaTitle()->or("Ready to Get Started?"),
    'ctaDescription' => $page->ctaDescription()->value()
  ]) ?>
</div>

<?php snippet('footer') ?>

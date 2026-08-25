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

<!-- Sidecar: Free Scanner Tool -->
<?php if ($isSidecar): ?>
  <?php snippet('sidecar-scanner') ?>
<?php endif ?>

<!-- Sidecar: Stats Cards -->
<?php if ($isSidecar && $page->stats()->isNotEmpty()): ?>
<section class="sidecar-stats">
  <div class="container">
    <div class="sidecar-stats__grid">
      <?php foreach ($page->stats()->toStructure() as $stat): ?>
        <div class="sidecar-stat">
          <div class="sidecar-stat__number"><?= $stat->number() ?></div>
          <div class="sidecar-stat__label"><?= $stat->label() ?></div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Sidecar: Transformation Statement -->
<?php if ($isSidecar): ?>
<section class="transformation">
  <div class="container">
    <p class="transformation__text">
      <span class="transformation__before">Wearing every hat in your business.</span><br>
      <span class="transformation__after">Wearing only the ones you're great at.</span>
    </p>
  </div>
</section>
<?php endif ?>

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

<!-- Sidecar: Benefit Table -->
<?php if ($isSidecar && $page->benefitsSidecar()->isNotEmpty()): ?>
<section class="benefit-table">
  <div class="container">
    <h2 class="benefit-table__title">What Changes</h2>
    <div class="benefit-table__grid">
      <div class="benefit-table__column benefit-table__column--sidecar">
        <h3 class="benefit-table__column-title">What Sidecar Handles</h3>
        <?php foreach ($page->benefitsSidecar()->toStructure() as $item): ?>
          <div class="benefit-table__item"><?= $item->item() ?></div>
        <?php endforeach ?>
      </div>
      <div class="benefit-table__column benefit-table__column--you">
        <h3 class="benefit-table__column-title">What That Frees You To Do</h3>
        <?php foreach ($page->benefitsYou()->toStructure() as $item): ?>
          <div class="benefit-table__item"><?= $item->item() ?></div>
        <?php endforeach ?>
      </div>
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

<!-- Sidecar: For You / Not For You Qualifier -->
<?php if ($isSidecar && $page->qualifierYes()->isNotEmpty()): ?>
<section class="qualifier">
  <div class="container">
    <h2 class="qualifier__title">Is Sidecar Right For You?</h2>
    <div class="qualifier__grid">
      <div class="qualifier__column">
        <h3 class="qualifier__column-title qualifier__column-title--yes">&#10003; Great Fit</h3>
        <?php foreach ($page->qualifierYes()->toStructure() as $item): ?>
          <div class="qualifier__item">
            <span class="qualifier__icon">&#10003;</span>
            <span><?= $item->item() ?></span>
          </div>
        <?php endforeach ?>
      </div>
      <div class="qualifier__column">
        <h3 class="qualifier__column-title qualifier__column-title--no">&#10007; Not The Right Fit</h3>
        <?php foreach ($page->qualifierNo()->toStructure() as $item): ?>
          <div class="qualifier__item">
            <span class="qualifier__icon">&#10007;</span>
            <span><?= $item->item() ?></span>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Sidecar: FAQ -->
<?php if ($isSidecar && $page->faq()->isNotEmpty()): ?>
<section class="sidecar-faq">
  <div class="container">
    <h2 class="sidecar-faq__title">Common Questions</h2>
    <div class="sidecar-faq__list">
      <?php foreach ($page->faq()->toStructure() as $item): ?>
        <div class="sidecar-faq__item">
          <h3 class="sidecar-faq__question"><?= $item->question() ?></h3>
          <p class="sidecar-faq__answer"><?= $item->answer() ?></p>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Sidecar: Walkthrough front-door offer -->
<?php if ($isSidecar): ?>
<?php snippet('walkthrough-cta') ?>
<?php endif ?>

<!-- Sidecar: Capacity + Pricing Anchor -->
<?php if ($isSidecar): ?>
<div class="scarcity">
  <p>We have capacity for <strong>5 new Sidecar partners per month</strong>. Builds from $1,000, half up front, half when it goes live. From $250/mo to run.</p>
</div>
<?php endif ?>

<!-- Contact Form -->
<div id="contact-form" class="<?= $isSidecar ? 'service-form--sidecar' : '' ?>">
  <?php snippet('service-contact-form', [
    'ctaTitle' => $isSidecar ? "See which hats you can take off." : $page->ctaTitle()->or("Ready to Get Started?"),
    'ctaDescription' => $page->ctaDescription()->value()
  ]) ?>
</div>

<?php snippet('footer') ?>

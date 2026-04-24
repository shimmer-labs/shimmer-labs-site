<?php snippet('header') ?>

<section class="about-hero">
  <div class="container">
    <div class="about-hero__inner">
      <div class="about-hero__text">
        <span class="cs-tag">About</span>
        <h1 class="about-hero__headline">
          <?= $page->headline()->or("Hi, I'm Logan.") ?>
        </h1>
        <?php if ($page->tagline()->isNotEmpty()): ?>
          <p class="about-hero__tagline"><?= $page->tagline() ?></p>
        <?php endif ?>
      </div>
      <?php if ($page->headshot()->isNotEmpty()): ?>
        <?php $headshot = $page->image($page->headshot()); ?>
        <?php if ($headshot): ?>
          <div class="about-hero__portrait">
            <img src="<?= $headshot->url() ?>" alt="Logan Shimmer, Founder of Shimmer Labs">
          </div>
        <?php endif ?>
      <?php endif ?>
    </div>
  </div>
</section>

<section class="about-content">
  <div class="container">
    <div class="about-content__body">
      <?= $page->text()->kt() ?>
    </div>
  </div>
</section>

<!-- Final CTA -->
<section class="cta-final">
  <div class="container">
    <div class="cta-final__content">
      <h2>Got a problem? Let's build the fix.</h2>
      <a href="/contact" class="btn btn--cta">Get in Touch</a>
    </div>
  </div>
</section>

<?php snippet('footer') ?>

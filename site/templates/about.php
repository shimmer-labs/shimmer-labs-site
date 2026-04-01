<?php snippet('header') ?>

<section class="about-hero">
  <div class="container">
    <h1 class="about-hero__title"><?= $page->title() ?></h1>
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
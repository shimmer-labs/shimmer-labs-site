<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <span class="cs-tag">Comparison</span>
      <h1 class="hero__title"><?= $page->title() ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->intro() ?></p>
      <?php endif ?>
    </div>
  </section>

  <section class="long-form">
    <div class="container">
      <div class="long-form__body">
        <?= $page->text()->kt() ?>
      </div>
    </div>
  </section>
</main>

<section class="cta-final">
  <div class="container">
    <div class="cta-final__content">
      <h2>Want a real answer about whether Shimmer Labs fits your situation?</h2>
      <p>Bring it to Office Hours, or book a 30-minute call. No pitch.</p>
      <a href="<?= url('contact') ?>" class="btn btn--cta">Book a Call</a>
    </div>
  </div>
</section>

<?php snippet('footer') ?>

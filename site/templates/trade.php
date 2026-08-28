<?php snippet('header') ?>

<main class="main-content">
  <?php $heroImage = $page->hero_image()->toFile(); ?>
  <section class="cs-hero<?php e($heroImage, ' cs-hero--has-image') ?>">
    <?php if ($heroImage): ?>
      <img class="cs-hero__bg" src="<?= $heroImage->url() ?>" alt="" aria-hidden="true">
      <div class="cs-hero__overlay"></div>
    <?php endif ?>
    <div class="container cs-hero__inner">
      <span class="cs-tag"><?= $page->eyebrow()->or('Stillwater, OK') ?></span>
      <h1 class="cs-hero__headline"><?= $page->hero_title()->or($page->title()) ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="cs-hero__subhead"><?= $page->intro() ?></p>
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

  <?php if ($page->faq()->isNotEmpty()): ?>
  <section class="long-form">
    <div class="container">
      <div class="long-form__body">
      <div class="landing-content__block landing-faq">
        <h2>Questions people ask</h2>
        <?php foreach ($page->faq()->toStructure() as $item): ?>
          <div class="landing-faq__item">
            <h3 class="landing-faq__q"><?= $item->question() ?></h3>
            <div class="landing-faq__a"><?= $item->answer()->kt() ?></div>
          </div>
        <?php endforeach ?>
      </div>
      <div class="landing-byline">
        <p>Written by <strong>Logan Shimmer</strong>, founder of Shimmer Labs, a software and AI studio in Stillwater, Oklahoma. <a href="<?= url('about') ?>">More about Logan &rarr;</a></p>
      </div>
      </div>
    </div>
  </section>
  <?php endif ?>
</main>

<?php if ($page->cta_type()->toString() === 'intake'): ?>
<section class="cta-final">
  <div class="container">
    <div class="cta-final__content">
      <h2>Start with the intake form</h2>
      <p>Ten minutes of honest answers about what eats your week. Logan reads every one and replies within a business day.</p>
      <a href="<?= url('intake') ?>" class="btn btn--cta">Fill Out the Intake →</a>
    </div>
  </div>
</section>
<?php else: ?>
<?php snippet('walkthrough-cta') ?>
<?php endif ?>

<?php snippet('footer') ?>

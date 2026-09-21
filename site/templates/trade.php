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

  <?php if ($page->show_map()->toBool()): ?>
  <section class="local-map">
    <div class="container">
      <h2 class="local-map__title">Where to find us in Stillwater</h2>
      <p class="local-map__address">WorkIT &middot; 901 S Main St, Suite 86, Stillwater, OK 74074 &middot; <a href="<?= url('office-hours') ?>">Free AI Office Hours Tue &amp; Thu, 2 to 3 PM</a></p>
      <div class="local-map__embed">
        <iframe
          src="https://www.google.com/maps?q=Shimmer+Labs,901+S+Main+St+Suite+86,Stillwater,OK+74074&output=embed"
          width="100%"
          height="450"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Map of Shimmer Labs at WorkIT, 901 S Main St Suite 86, Stillwater, OK">
        </iframe>
      </div>
    </div>
  </section>
  <?php endif ?>
</main>

<?php snippet('related-links') ?>

<?php snippet('scanner-inline') ?>

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

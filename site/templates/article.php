<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <span class="cs-tag"><?= $page->eyebrow()->or('Notes') ?></span>
      <h1 class="hero__title"><?= $page->title() ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->intro() ?></p>
      <?php endif ?>
      <?php if ($page->date()->isNotEmpty()): ?>
        <p class="hero__intro"><small><?= $page->date()->toDate('F j, Y') ?></small></p>
      <?php endif ?>
    </div>
  </section>

  <section class="long-form">
    <div class="container">
      <div class="long-form__body">
        <?= $page->text()->kt() ?>

      <?php if ($page->faq()->isNotEmpty()): ?>
      <div class="landing-content__block landing-faq">
        <h2>Related questions</h2>
        <?php foreach ($page->faq()->toStructure() as $item): ?>
          <div class="landing-faq__item">
            <h3 class="landing-faq__q"><?= $item->question() ?></h3>
            <div class="landing-faq__a"><?= $item->answer()->kt() ?></div>
          </div>
        <?php endforeach ?>
      </div>
      <?php endif ?>

      <div class="landing-byline">
        <p>Written by <strong>Logan Shimmer</strong>, founder of Shimmer Labs, a software and AI studio in Stillwater, Oklahoma. <a href="<?= url('about') ?>">More about Logan &rarr;</a></p>
      </div>
      </div>
    </div>
  </section>
</main>

<?php snippet('walkthrough-cta') ?>

<?php snippet('footer') ?>

<section class="cs-hero<?php e($page->hero_image()->toFile(), ' cs-hero--has-image') ?>">
  <?php if ($heroImage = $page->hero_image()->toFile()): ?>
    <img class="cs-hero__bg" src="<?= $heroImage->url() ?>" alt="" aria-hidden="true">
    <div class="cs-hero__overlay"></div>
  <?php endif ?>
  <div class="container cs-hero__inner">
    <div class="cs-hero__eyebrow">
      <span class="cs-tag">Case Study</span>
      <?php if ($page->badge()->isNotEmpty()): ?>
        <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $page->badge())) ?>">
          <?= $page->badge() ?>
        </span>
      <?php endif ?>
    </div>
    <?php if ($page->hero_quote()->isNotEmpty()): ?>
      <h1 class="visually-hidden"><?= $page->title() ?></h1>
      <blockquote class="cs-hero__quote">
        <?= $page->hero_quote() ?>
      </blockquote>
      <?php if ($page->hero_quote_attribution()->isNotEmpty()): ?>
        <cite class="cs-hero__attribution"><?= $page->hero_quote_attribution() ?></cite>
      <?php endif ?>
    <?php elseif ($page->hero_headline()->isNotEmpty()): ?>
      <h1 class="cs-hero__headline"><?= $page->hero_headline() ?></h1>
    <?php else: ?>
      <h1 class="cs-hero__title"><?= $page->title() ?></h1>
    <?php endif ?>
    <?php if ($page->hero_subhead()->isNotEmpty()): ?>
      <p class="cs-hero__subhead"><?= $page->hero_subhead() ?></p>
    <?php endif ?>
  </div>
</section>

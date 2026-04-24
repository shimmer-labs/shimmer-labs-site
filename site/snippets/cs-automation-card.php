<?php
  $statusRaw  = $automation->status()->value() ?: 'Live';
  $statusSlug = strtolower(str_replace(' ', '-', $statusRaw));
  $screenshots = $automation->screenshot()->toFiles();
?>
<article class="automation-card automation-card--<?= $statusSlug ?>">
  <header class="automation-card__header">
    <span class="automation-card__status automation-card__status--<?= $statusSlug ?>"><?= $statusRaw ?></span>
    <h3 class="automation-card__title"><?= $automation->title() ?></h3>
  </header>

  <?php if ($automation->description()->isNotEmpty()): ?>
    <div class="automation-card__body">
      <?= $automation->description()->kt() ?>
    </div>
  <?php endif ?>

  <?php if ($screenshots->count() > 0): ?>
    <div class="automation-card__screenshots automation-card__screenshots--<?= $screenshots->count() === 2 ? 'pair' : 'single' ?>">
      <?php foreach ($screenshots as $shot): ?>
        <figure class="automation-card__screenshot">
          <img src="<?= $shot->url() ?>" alt="<?= $automation->title() ?> screenshot" loading="lazy">
        </figure>
      <?php endforeach ?>
    </div>
    <?php if ($automation->screenshot_caption()->isNotEmpty()): ?>
      <p class="automation-card__caption"><?= $automation->screenshot_caption() ?></p>
    <?php endif ?>
  <?php endif ?>

  <?php if ($automation->pullquote()->isNotEmpty()): ?>
    <blockquote class="automation-card__pullquote">
      <?= $automation->pullquote() ?>
      <?php if ($automation->pullquote_attribution()->isNotEmpty()): ?>
        <cite class="automation-card__cite"><?= $automation->pullquote_attribution() ?></cite>
      <?php endif ?>
    </blockquote>
  <?php endif ?>
</article>

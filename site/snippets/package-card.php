<div class="package-card<?= $package->featured()->toBool() ? ' package-card--featured' : '' ?>">
  <?php if ($package->featured()->toBool()): ?>
    <div class="package-card__badge">⭐ Most Popular</div>
  <?php endif ?>

  <div class="package-card__header">
    <div class="package-card__icon">
      <?= $package->icon() ?>
    </div>
    <h3 class="package-card__title"><?= $package->title() ?></h3>
  </div>

  <div class="package-card__pricing">
    <?php if ($package->priceLabel()->isNotEmpty()): ?>
      <span class="package-card__price-label"><?= $package->priceLabel() ?></span>
    <?php endif ?>
    <div class="package-card__price"><?= $package->price() ?></div>
  </div>

  <p class="package-card__description">
    <?= $package->description() ?>
  </p>

  <?php if ($package->highlights()->isNotEmpty()): ?>
    <ul class="package-card__highlights">
      <?php foreach ($package->highlights()->split() as $highlight): ?>
        <li><?= $highlight ?></li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>

  <div class="package-card__cta">
    <?php if ($package->link()->isNotEmpty()): ?>
      <a href="<?= $package->link() ?>" class="btn btn--package">
        Learn More →
      </a>
    <?php else: ?>
      <a href="/contact" class="btn btn--package">
        Get Started →
      </a>
    <?php endif ?>
  </div>
</div>

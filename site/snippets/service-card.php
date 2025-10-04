<div class="service-card">
  <?php if ($service->icon()->isNotEmpty()): ?>
    <div class="service-card__icon"><?= $service->icon() ?></div>
  <?php endif ?>
  <h3 class="service-card__title"><?= $service->title() ?></h3>
  <p class="service-card__description"><?= $service->description() ?></p>
</div>
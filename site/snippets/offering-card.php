<div class="offering-card">
  <h3 class="offering-card__title"><?= $offering->title() ?></h3>
  <p class="offering-card__description"><?= $offering->description() ?></p>
  <?php if ($offering->status()->isNotEmpty()): ?>
    <span class="offering-card__status"><?= $offering->status() ?></span>
  <?php endif ?>
</div>
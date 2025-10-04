<section class="founder">
  <div class="container">
    <div class="founder__content">
      <div class="founder__text">
        <p class="founder__intro">
          You'll work directly with <?= $name ?>, <?= $title ?>.
        </p>
        <?= $bio->kt() ?>
      </div>
      <?php if ($image->isNotEmpty()): ?>
        <div class="founder__image">
          <img src="<?= $image->toFile()->url() ?>" alt="<?= $name ?>">
          <span class="founder__name"><?= $name ?></span>
        </div>
      <?php endif ?>
    </div>
  </div>
</section>
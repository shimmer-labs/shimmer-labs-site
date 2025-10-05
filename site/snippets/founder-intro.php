<section class="founder">
  <div class="container">
    <div class="founder__content">
      <div class="founder__text">
        <p class="founder__intro">
          You'll work directly with <?= $name ?>, <?= $title ?>.
        </p>
        <?= $bio->kt() ?>
      </div>
      <div class="founder__image">
        <img src="<?= url('assets/images/hero.jpg') ?>" alt="<?= $name ?>" class="founder__photo">
        <span class="founder__name"><?= $name ?></span>
      </div>
    </div>
  </div>
</section>
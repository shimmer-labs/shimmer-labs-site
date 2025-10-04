<?php if ($case): ?>
<section class="case-study-highlight">
  <div class="container">
    <div class="case-study-card">
      <?php if ($case->featuredImage()->isNotEmpty()): ?>
        <div class="case-study-card__image">
          <img src="<?= $case->featuredImage()->toFile()->url() ?>" alt="<?= $case->title() ?>">
        </div>
      <?php endif ?>
      <div class="case-study-card__content">
        <h3 class="case-study-card__title"><?= $case->title() ?></h3>
        <p class="case-study-card__excerpt"><?= $case->excerpt() ?></p>
        <a href="<?= $case->url() ?>" class="btn btn--link">Read case study →</a>
      </div>
    </div>
  </div>
</section>
<?php endif ?>
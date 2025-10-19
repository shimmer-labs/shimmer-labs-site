<?php snippet('header') ?>

<section class="contact-section">
  <div class="container">
    <div class="contact-content">
      <div class="contact-header">
        <h1><?= $page->title() ?></h1>
      </div>

      <div style="text-align: center; padding: 3rem 0;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">📡</div>
        <?= $page->text()->kt() ?>
        <div style="margin-top: 2rem;">
          <a href="/" class="btn btn--primary">Go to Homepage</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php snippet('footer') ?>

<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <span class="cs-tag">Stillwater, OK</span>
      <h1 class="hero__title"><?= $page->title() ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->intro() ?></p>
      <?php endif ?>
    </div>
  </section>

  <section class="long-form">
    <div class="container">
      <div class="long-form__body">
        <?= $page->text()->kt() ?>
      </div>
    </div>
  </section>

  <section class="local-map">
    <div class="container">
      <h2 class="local-map__title">Where to find us in Stillwater</h2>
      <p class="local-map__address">WorkIT &middot; 901 S Main St, Suite 86, Stillwater, OK 74074 &middot; <a href="<?= url('office-hours') ?>">Office Hours Tue &amp; Thu, 2&ndash;4 PM</a></p>
      <div class="local-map__embed">
        <iframe
          src="https://www.google.com/maps?q=Shimmer+Labs,901+S+Main+St+Suite+86,Stillwater,OK+74074&output=embed"
          width="100%"
          height="450"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Map of Shimmer Labs at WorkIT, 901 S Main St Suite 86, Stillwater, OK">
        </iframe>
      </div>
    </div>
  </section>
</main>

<section class="cta-final">
  <div class="container">
    <div class="cta-final__content">
      <h2>Walk in. Or book a call.</h2>
      <p>AI Office Hours every Tuesday &amp; Thursday, 2&ndash;4 PM at WorkIT, 901 S Main St Suite 86, Stillwater OK.</p>
      <a href="<?= url('contact') ?>" class="btn btn--cta">Book a 30-Minute Call</a>
    </div>
  </div>
</section>

<?php snippet('footer') ?>

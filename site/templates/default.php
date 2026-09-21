<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <h1 class="hero__title"><?= $page->title() ?></h1>
      <?php if ($page->text()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->text()->kt() ?></p>
      <?php endif ?>
      <p class="hero__intro">Head back to the <a href="<?= url('/') ?>">home page</a>, or come to free AI office hours at WorkIT in Stillwater, Tuesdays and Thursdays 2 to 3 PM. <a href="<?= url('office-hours') ?>">Details here</a>.</p>
    </div>
  </section>
</main>

<?php snippet('footer') ?>

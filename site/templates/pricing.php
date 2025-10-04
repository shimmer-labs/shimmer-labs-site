<?php snippet('header') ?>

<main>
  <h1><?= $page->headline()->html() ?></h1>
  <p><?= $page->subtext()->kirbytext() ?></p>
</main>

<?php snippet('footer') ?>
<?php snippet('header') ?>

<main>
  <h1><?= $page->title() ?></h1>
  <p><?= $page->intro() ?></p>

  <div class="cards">
    <?php foreach ($page->children()->listed() as $item): ?>
      <?php snippet('card', ['item' => $item]) ?>
    <?php endforeach ?>
  </div>
</main>

<?php snippet('footer') ?>
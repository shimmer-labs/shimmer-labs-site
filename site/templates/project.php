<?php snippet('header') ?>

<main>
  <h1><?= $page->title() ?></h1>
  <p><?= $page->summary() ?></p>

  <?php if ($image = $page->image()): ?>
    <img src="<?= $image->url() ?>" alt="<?= $page->title() ?>" style="max-width:100%; margin: 2rem 0;">
  <?php endif ?>

  <?php if ($page->results()->isNotEmpty()): ?>
    <h2>Results</h2>
    <p><?= $page->results() ?></p>
  <?php endif ?>

  <?php if ($page->tech_stack()->isNotEmpty()): ?>
    <h2>Tech Stack</h2>
    <ul>
      <?php foreach ($page->tech_stack()->split(',') as $tech): ?>
        <li><?= trim($tech) ?></li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>

  <?php if ($page->link()->isNotEmpty()): ?>
    <p><a href="<?= $page->link() ?>" target="_blank">View Project →</a></p>
  <?php endif ?>
</main>

<?php snippet('footer') ?>
<?php snippet('header') ?>

<main class="projects">
  <h1><?= $page->title() ?></h1>
  <p><?= $page->intro()->kirbytext() ?></p>

  <ul>
    <?php foreach ($page->children()->listed() as $project): ?>
      <li>
        <h2><a href="<?= $project->url() ?>"><?= $project->title() ?></a></h2>
        <p><?= $project->text()->excerpt(150) ?></p>
      </li>
    <?php endforeach ?>
  </ul>
</main>

<?php snippet('footer') ?>
<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <span class="cs-tag">Notes</span>
      <h1 class="hero__title"><?= $page->title() ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->intro() ?></p>
      <?php endif ?>
    </div>
  </section>

  <section class="long-form">
    <div class="container">
      <div class="long-form__body">
        <ul>
          <?php foreach ($page->children()->listed()->sortBy('date', 'desc') as $note): ?>
            <li>
              <a href="<?= $note->url() ?>"><?= $note->title() ?></a>
              <?php if ($note->intro()->isNotEmpty()): ?> &mdash; <?= $note->intro() ?><?php endif ?>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </section>
</main>

<?php snippet('footer') ?>

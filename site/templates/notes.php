<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <span class="cs-tag"><?= $page->eyebrow()->or('Notes') ?></span>
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
              <?php if ($note->intro()->isNotEmpty()): ?>: <?= $note->intro() ?><?php endif ?>
            </li>
          <?php endforeach ?>
        </ul>
        <?php if ($page->slug() === 'notes' && ($a = page('automate-first'))): ?>
          <p class="notes-crosslink">Looking for your trade? <a href="<?= $a->url() ?>">What should you automate first?</a> has one page per trade, prompts included.</p>
        <?php elseif ($page->slug() === 'automate-first' && ($n = page('notes'))): ?>
          <p class="notes-crosslink">Want the math behind these? The <a href="<?= $n->url() ?>">notes</a> cover cost per employee, hours saved, and why most AI pilots stall.</p>
        <?php endif ?>
      </div>
    </div>
  </section>
</main>

<?php snippet('footer') ?>

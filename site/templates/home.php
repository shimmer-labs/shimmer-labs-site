<?php snippet('header') ?>

<main>
  <section>
    <h1><?= $page->headline() ?> ✨</h1>
    <h1><?= $page->headline()->or('Automate Your Business. Reclaim Your Time.') ?></h1>
    <p><?= $page->subheadline()->or('We help small business owners untangle their tech, connect their tools, and build automations that just work.') ?></p>
    <a href="/contact"><?= $page->cta_button()->or('Let’s Build Your Workflow') ?></a>
  </section>

  <section>
  <h2>Services</h2>
  <div class="cards">
    <?php foreach ($pages->find('services')->children()->listed() as $item): ?>
      <?php snippet('card', ['item' => $item]) ?>
    <?php endforeach ?>
  </div>
</section>

  <section>
  <h2>Featured Projects</h2>
  <div class="cards">
    <?php foreach ($pages->find('projects')->children()->listed() as $item): ?>
      <?php snippet('card', ['item' => $item]) ?>
    <?php endforeach ?>
  </div>
</section>
</main>

<?php snippet('footer') ?>
<section class="cs-stats">
  <div class="container">
    <div class="cs-stats__inner">
      <?php if ($page->results_intro()->isNotEmpty()): ?>
        <p class="cs-stats__intro"><?= $page->results_intro() ?></p>
      <?php endif ?>

      <div class="cs-stats__headline">
        <span class="cs-stats__number"><?= $page->results_headline_stat() ?></span>
        <span class="cs-stats__label"><?= $page->results_headline_label() ?></span>
      </div>

      <?php if ($page->results_supporting_stats()->isNotEmpty()): ?>
        <div class="cs-stats__supporting">
          <?php foreach ($page->results_supporting_stats()->toStructure() as $stat): ?>
            <div class="cs-stats__mini">
              <span class="cs-stats__mini-number"><?= $stat->number() ?></span>
              <span class="cs-stats__mini-label"><?= $stat->label() ?></span>
            </div>
          <?php endforeach ?>
        </div>
      <?php endif ?>

      <?php if ($page->results_context()->isNotEmpty()): ?>
        <div class="cs-stats__context"><?= $page->results_context()->kt() ?></div>
      <?php endif ?>
    </div>
  </div>
</section>

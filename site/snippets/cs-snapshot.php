<section class="cs-snapshot">
  <div class="container">
    <dl class="cs-snapshot__grid">
      <?php if ($page->client_name()->isNotEmpty()): ?>
        <div class="cs-snapshot__item">
          <dt>Business</dt>
          <dd>
            <?php if ($page->client_website()->isNotEmpty()): ?>
              <a href="<?= $page->client_website() ?>" target="_blank" rel="noopener"><?= $page->client_name() ?> ↗</a>
            <?php else: ?>
              <?= $page->client_name() ?>
            <?php endif ?>
          </dd>
        </div>
      <?php endif ?>
      <?php if ($page->client_role()->isNotEmpty()): ?>
        <div class="cs-snapshot__item">
          <dt>Owner</dt>
          <dd><?= $page->client_role() ?></dd>
        </div>
      <?php endif ?>
      <?php if ($page->client_location()->isNotEmpty()): ?>
        <div class="cs-snapshot__item">
          <dt>Location</dt>
          <dd><?= $page->client_location() ?></dd>
        </div>
      <?php endif ?>
      <?php if ($page->engagement_type()->isNotEmpty()): ?>
        <div class="cs-snapshot__item">
          <dt>Engagement</dt>
          <dd>
            <?= $page->engagement_type() ?>
            <?php if ($page->engagement_timeline()->isNotEmpty()): ?>
              <span class="cs-snapshot__sub"><?= $page->engagement_timeline() ?></span>
            <?php endif ?>
          </dd>
        </div>
      <?php endif ?>
      <?php if ($page->platforms()->isNotEmpty()): ?>
        <div class="cs-snapshot__item cs-snapshot__item--wide">
          <dt>Platforms</dt>
          <dd><?= $page->platforms() ?></dd>
        </div>
      <?php endif ?>
    </dl>
  </div>
</section>

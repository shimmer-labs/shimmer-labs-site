<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <h1 class="hero__title">Case Studies</h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->intro() ?></p>
      <?php endif ?>
    </div>
  </section>

  <?php
  $allItems = $page->children()->listed();
  $featured = $allItems->filter(fn($p) => $p->featured()->toBool() === true);
  $more     = $allItems->filter(fn($p) => $p->featured()->toBool() !== true);
  ?>

  <?php if ($featured->isNotEmpty()): ?>
  <section class="projects projects--featured">
    <div class="container">
      <h2 class="projects__section-title">Featured Case Studies</h2>
      <div class="projects__grid projects__grid--featured">
        <?php foreach ($featured as $item): ?>
          <article class="project-card project-card--featured">
            <?php if ($item->badge()->isNotEmpty()): ?>
              <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $item->badge())) ?>">
                <?= $item->badge() ?>
              </span>
            <?php endif ?>

            <?php
              $thumbnail = null;
              if ($item->intendedTemplate()->name() === 'case-study' && $item->hero_image()->isNotEmpty()) {
                $thumbnail = $item->hero_image()->toFile();
              } elseif ($item->images()->first()) {
                $thumbnail = $item->images()->first();
              }
            ?>
            <?php if ($thumbnail): ?>
              <div class="project-card__thumbnail">
                <img src="<?= $thumbnail->url() ?>" alt="<?= $item->title() ?> preview" loading="lazy">
              </div>
            <?php endif ?>

            <h3 class="project-card__title">
              <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
            </h3>

            <p class="project-card__summary"><?= $item->summary() ?></p>

            <?php if ($item->tech_stack()->isNotEmpty()): ?>
              <div class="project-card__tech">
                <?php foreach ($item->tech_stack()->split(',') as $tech): ?>
                  <span class="tech-tag"><?= trim($tech) ?></span>
                <?php endforeach ?>
              </div>
            <?php endif ?>

            <a href="<?= $item->url() ?>" class="btn btn--primary">
              <?= $item->intendedTemplate()->name() === 'case-study' ? 'Read the case study →' : 'View Project →' ?>
            </a>
          </article>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <?php endif ?>

  <?php if ($more->isNotEmpty()): ?>
  <section class="projects projects--more">
    <div class="container">
      <h2 class="projects__section-title">More Work</h2>
      <div class="projects__grid projects__grid--more">
        <?php foreach ($more as $item): ?>
          <article class="project-card project-card--compact">
            <?php if ($item->badge()->isNotEmpty()): ?>
              <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $item->badge())) ?>">
                <?= $item->badge() ?>
              </span>
            <?php endif ?>

            <h3 class="project-card__title">
              <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
            </h3>

            <p class="project-card__summary"><?= $item->summary()->excerpt(120) ?></p>

            <a href="<?= $item->url() ?>" class="btn btn--link">View →</a>
          </article>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <?php endif ?>
</main>

<?php snippet('footer') ?>

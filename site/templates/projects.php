<?php snippet('header') ?>

<main class="main-content">
  <section class="hero hero--compact">
    <div class="container">
      <h1 class="hero__title">Projects</h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->intro() ?></p>
      <?php endif ?>
    </div>
  </section>

  <?php
  // Get all child project pages
  $allProjects = $page->children()->listed();
  $featuredProjects = $allProjects->filter(function($project) {
    return $project->featured()->toBool() === true;
  });
  $moreProjects = $allProjects->filter(function($project) {
    return $project->featured()->toBool() !== true;
  });
  ?>

  <?php if ($featuredProjects->isNotEmpty()): ?>
  <!-- Featured Projects Section -->
  <section class="projects projects--featured">
    <div class="container">
      <h2 class="projects__section-title">Featured Projects</h2>
      <div class="projects__grid projects__grid--featured">
        <?php foreach ($featuredProjects as $project): ?>
          <article class="project-card project-card--featured">
            <?php if ($project->badge()->isNotEmpty()): ?>
              <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $project->badge())) ?>">
                <?= $project->badge() ?>
              </span>
            <?php endif ?>

            <h3 class="project-card__title">
              <a href="<?= $project->url() ?>"><?= $project->title() ?></a>
            </h3>

            <p class="project-card__summary"><?= $project->summary() ?></p>

            <?php if ($project->tech_stack()->isNotEmpty()): ?>
              <div class="project-card__tech">
                <?php foreach ($project->tech_stack()->split(',') as $tech): ?>
                  <span class="tech-tag"><?= trim($tech) ?></span>
                <?php endforeach ?>
              </div>
            <?php endif ?>

            <a href="<?= $project->url() ?>" class="btn btn--primary">
              View Project →
            </a>
          </article>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <?php endif ?>

  <?php if ($moreProjects->isNotEmpty()): ?>
  <!-- More Projects Section -->
  <section class="projects projects--more">
    <div class="container">
      <h2 class="projects__section-title">More Projects</h2>
      <div class="projects__grid projects__grid--more">
        <?php foreach ($moreProjects as $project): ?>
          <article class="project-card project-card--compact">
            <?php if ($project->badge()->isNotEmpty()): ?>
              <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $project->badge())) ?>">
                <?= $project->badge() ?>
              </span>
            <?php endif ?>

            <h3 class="project-card__title">
              <a href="<?= $project->url() ?>"><?= $project->title() ?></a>
            </h3>

            <p class="project-card__summary"><?= $project->summary()->excerpt(120) ?></p>

            <a href="<?= $project->url() ?>" class="btn btn--link">
              View Project →
            </a>
          </article>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <?php endif ?>
</main>

<?php snippet('footer') ?>

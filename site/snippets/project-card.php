<?php if ($project->badge() == 'Coming Soon'): ?>
  <div class="project-card project-card--coming-soon">
    <div class="project-card__content">
      <div class="project-card__header">
        <h3 class="project-card__title"><?= $project->title() ?></h3>
        <span class="project-card__badge project-card__badge--coming-soon">
          <?= $project->badge() ?>
        </span>
      </div>
      <p class="project-card__description"><?= $project->summary() ?></p>
    </div>
  </div>
<?php else: ?>
  <a href="<?= $project->url() ?>" class="project-card">
    <div class="project-card__content">
      <div class="project-card__header">
        <h3 class="project-card__title"><?= $project->title() ?></h3>
        <?php if ($project->badge()->isNotEmpty()): ?>
          <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $project->badge())) ?>">
            <?= $project->badge() ?>
          </span>
        <?php endif ?>
      </div>
      <p class="project-card__description"><?= $project->summary() ?></p>
    </div>
  </a>
<?php endif ?>
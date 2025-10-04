<?php if ($projects && $projects->isNotEmpty()): ?>
<section class="projects">
  <div class="container">
    <h2 class="projects__title">Featured Projects</h2>
    <div class="projects__grid">
      <?php foreach ($projects->toStructure() as $project): ?>
        <div class="project-card <?php e($project->status()->value() == 'coming-soon', 'project-card--coming-soon') ?>">
          <?php if ($project->icon()->isNotEmpty()): ?>
            <div class="project-card__icon"><?= $project->icon() ?></div>
          <?php endif ?>
          
          <h3 class="project-card__title"><?= $project->title() ?></h3>
          <p class="project-card__description"><?= $project->description() ?></p>
          
          <?php if ($project->status()->value() == 'coming-soon'): ?>
            <span class="project-card__badge">Coming Soon</span>
          <?php elseif ($project->url()->isNotEmpty()): ?>
            <a href="<?= $project->url() ?>" class="btn btn--link" target="_blank" rel="noopener">
              View Project →
            </a>
          <?php endif ?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>
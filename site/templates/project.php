<?php snippet('header') ?>

<section class="project-detail">
  <div class="container-wide">
    <div class="project-layout">
      <!-- Main Content -->
      <div class="project-main">
        <!-- Header -->
        <div class="project-detail__header">
          <h1><?= $page->title() ?></h1>
          <?php if ($page->badge()->isNotEmpty()): ?>
            <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $page->badge())) ?>">
              <?= $page->badge() ?>
            </span>
          <?php endif ?>
        </div>

        <p class="project-detail__summary"><?= $page->summary() ?></p>

        <!-- Tech Stack -->
        <?php if ($page->tech_stack()->isNotEmpty()): ?>
          <div class="project-detail__tech">
            <h3>Tech Stack</h3>
            <ul class="tech-stack-list">
              <?php foreach ($page->tech_stack()->split(',') as $tech): ?>
                <li><?= trim($tech) ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>

        <!-- Gallery -->
        <?php if ($page->images()->count() > 0 || $page->video_url()->isNotEmpty()): ?>
          <div class="project-gallery">
            <h3>Gallery</h3>
            
            <div class="gallery-featured" id="galleryFeatured">
              <?php if ($page->video_url()->isNotEmpty()): ?>
                <iframe 
                  id="featuredVideo"
                  src="<?= $page->video_url() ?>" 
                  frameborder="0" 
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                  allowfullscreen>
                </iframe>
              <?php else: ?>
                <?php $firstImage = $page->images()->first(); ?>
                <img id="featuredImage" src="<?= $firstImage->url() ?>" alt="<?= $firstImage->alt() ?>" class="zoomable">
                <div class="zoom-hint">🔍 Click to enlarge</div>
              <?php endif ?>
            </div>
            
            <div class="gallery-thumbnails">
              <?php if ($page->video_url()->isNotEmpty()): ?>
                <div class="thumbnail thumbnail--active" data-type="video" data-src="<?= $page->video_url() ?>">
                  <div class="thumbnail-video-indicator">▶</div>
                </div>
              <?php endif ?>
              
              <?php foreach ($page->images() as $index => $image): ?>
                <div class="thumbnail <?php e($index === 0 && $page->video_url()->isEmpty(), 'thumbnail--active') ?>" 
                     data-type="image" 
                     data-src="<?= $image->url() ?>">
                  <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>">
                </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif ?>

        <!-- Detailed Description -->
        <?php if ($page->description()->isNotEmpty()): ?>
          <div class="project-detail__description">
            <h3>How It Works</h3>
            <?= $page->description()->kt() ?>
          </div>
        <?php endif ?>

        <!-- Results -->
        <?php if ($page->results()->isNotEmpty()): ?>
          <div class="project-detail__results">
            <h3>Results</h3>
            <p><?= $page->results() ?></p>
          </div>
        <?php endif ?>

        <!-- CTA -->
        <div class="project-detail__cta">
          <?php if ($page->link()->isNotEmpty()): ?>
            <a href="<?= $page->link() ?>" class="btn btn--cta" target="_blank" rel="noopener">
              View Live Project →
            </a>
          <?php endif ?>
          <a href="<?= url('contact') ?>" class="btn btn--secondary">
            Build Something Similar
          </a>
        </div>
      </div>

<!-- Sidebar -->
<aside class="project-sidebar">
  <div class="sidebar-sticky">
    <h3>Other Projects</h3>
    <div class="sidebar-projects">
      <?php 
      $otherProjects = $page->parent()
        ->children()
        ->listed()
        ->not($page)
        ->filterBy('badge', '!=', 'Coming Soon')
        ->limit(4);
      
      foreach ($otherProjects as $otherProject): 
      ?>
        <a href="<?= $otherProject->url() ?>" class="sidebar-project-card">
          <div class="sidebar-project-header">
            <h4><?= $otherProject->title() ?></h4>
            <?php if ($otherProject->badge()->isNotEmpty()): ?>
              <span class="project-card__badge project-card__badge--<?= strtolower(str_replace(' ', '-', $otherProject->badge())) ?>">
                <?= $otherProject->badge() ?>
              </span>
            <?php endif ?>
          </div>
          <p><?= $otherProject->summary()->excerpt(80) ?></p>
        </a>
      <?php endforeach ?>
    </div>

    <a href="<?= url('contact') ?>" class="btn btn--cta sidebar-cta">
      Start Your Project
    </a>
  </div>
</aside>

<!-- Lightbox for images -->
<div class="lightbox" id="lightbox" style="display: none;">
  <button class="lightbox-close">&times;</button>
  <img src="" alt="" class="lightbox-image">
</div>

<?php snippet('footer') ?>
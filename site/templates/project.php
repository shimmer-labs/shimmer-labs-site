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

        <!-- Waitlist Section (for pre-launch apps) -->
        <?php if ($page->is_app()->toBool() && $page->badge()->toString() === 'Launching Soon'): ?>
          <?php snippet('app-waitlist', [
            'app_name' => $page->title(),
            'formspree_id' => 'xnngrlnp', // EventSnag waitlist → logan@shimmerlabs.co
            'launch_date' => 'Late October 2025'
          ]) ?>
        <?php endif ?>

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
        <?php
          $hasLocalVideo = $page->demo_video()->isNotEmpty() && $page->demo_video()->toFile();
          $hasYouTubeVideo = $page->video_url()->isNotEmpty();
          $hasVideo = $hasLocalVideo || $hasYouTubeVideo;
        ?>
        <?php if ($page->images()->count() > 0 || $hasVideo): ?>
          <div class="project-gallery">
            <h3>Gallery</h3>

            <div class="gallery-featured" id="galleryFeatured">
              <?php if ($hasLocalVideo): ?>
                <?php $demoVideo = $page->demo_video()->toFile(); ?>
                <video
                  id="featuredVideo"
                  controls
                  autoplay
                  muted
                  loop
                  playsinline
                  style="width: 100%; height: auto; display: block;">
                  <source src="<?= $demoVideo->url() ?>" type="video/<?= $demoVideo->extension() ?>">
                  Your browser doesn't support video playback.
                </video>
              <?php elseif ($hasYouTubeVideo): ?>
                <iframe
                  id="featuredVideo"
                  src="<?= $page->video_url() ?>"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen>
                </iframe>
              <?php else: ?>
                <?php $firstImage = $page->images()->first(); ?>
                <?php
                  // Safely get alt text with fallback
                  $altText = $firstImage && method_exists($firstImage, 'alt') && $firstImage->alt()->isNotEmpty()
                    ? $firstImage->alt()->toString()
                    : $page->title() . ' - Screenshot';
                ?>
                <img id="featuredImage" src="<?= $firstImage->url() ?>" alt="<?= $altText ?>" class="zoomable">
                <div class="zoom-hint">🔍 Click to enlarge</div>
              <?php endif ?>
            </div>

            <div class="gallery-thumbnails">
              <?php if ($hasVideo): ?>
                <div class="thumbnail thumbnail--active" data-type="video" <?php if ($hasLocalVideo): ?>data-src="<?= $demoVideo->url() ?>" data-video-type="local"<?php else: ?>data-src="<?= $page->video_url() ?>" data-video-type="youtube"<?php endif ?>>
                  <div class="thumbnail-video-indicator">▶</div>
                </div>
              <?php endif ?>

              <?php foreach ($page->images() as $index => $image): ?>
                <?php
                  // Safely get alt text with fallback
                  $thumbnailAlt = method_exists($image, 'alt') && $image->alt()->isNotEmpty()
                    ? $image->alt()->toString()
                    : $page->title() . ' - Screenshot ' . ($index + 1);
                ?>
                <div class="thumbnail <?php e($index === 0 && !$hasVideo, 'thumbnail--active') ?>"
                     data-type="image"
                     data-src="<?= $image->url() ?>">
                  <img src="<?= $image->url() ?>" alt="<?= $thumbnailAlt ?>">
                </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif ?>

        <!-- Detailed Description -->
        <?php if ($page->description()->isNotEmpty()): ?>
          <div class="project-detail__description">
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

        <!-- App Store Download (for mobile apps) -->
        <?php if ($page->is_app()->toBool()): ?>
          <?php snippet('app-download', [
            'url' => $page->app_store_url(),
            'app_name' => $page->title()
          ]) ?>
        <?php endif ?>

        <!-- CTA -->
        <div class="project-detail__cta">
          <?php if ($page->link()->isNotEmpty() && !$page->is_app()->toBool()): ?>
            <a href="<?= $page->link() ?>" class="btn btn--cta" target="_blank" rel="noopener">
              View Live Project →
            </a>
          <?php endif ?>
          <?php if ($page->link()->isNotEmpty() && $page->is_app()->toBool()): ?>
            <a href="<?= $page->link() ?>" class="btn btn--secondary" target="_blank" rel="noopener">
              View on GitHub →
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
</div><!-- Close sidebar -->
    </div><!-- Close .project-layout -->
  </div><!-- Close .container-wide -->
</section><!-- Close .project-detail -->

<!-- App Legal Footer (Privacy, Terms, Support) -->
<?php if ($page->is_app()->toBool()): ?>
<section class="app-legal-footer">
  <div class="container">
    <div class="app-legal-footer__content">
      <p>Legal & Support</p>
      <ul class="app-legal-links">
        <?php
          // Check for external URL first, fallback to child page
          $privacyUrl = $page->privacy_url()->isNotEmpty() ? $page->privacy_url()->toString() : ($page->find('privacy') ? $page->url() . '/privacy' : null);
          if ($privacyUrl):
        ?>
          <li><a href="<?= $privacyUrl ?>">Privacy Policy</a></li>
        <?php endif ?>

        <?php
          $termsUrl = $page->terms_url()->isNotEmpty() ? $page->terms_url()->toString() : ($page->find('terms') ? $page->url() . '/terms' : null);
          if ($termsUrl):
        ?>
          <li><a href="<?= $termsUrl ?>">Terms of Service</a></li>
        <?php endif ?>

        <?php
          $supportUrl = $page->support_url()->isNotEmpty() ? $page->support_url()->toString() : ($page->find('support') ? $page->url() . '/support' : null);
          if ($supportUrl):
        ?>
          <li><a href="<?= $supportUrl ?>">Support & FAQ</a></li>
        <?php endif ?>

        <li><a href="<?= url('contact') ?>">Contact Us</a></li>
      </ul>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Lightbox for images -->
<div class="lightbox" id="lightbox" style="display: none;">
  <button class="lightbox-close">&times;</button>
  <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E" alt="" class="lightbox-image">
</div>

<?php snippet('footer') ?>
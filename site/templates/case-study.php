<?php snippet('header') ?>

<main class="case-study">
  <?php snippet('cs-hero', ['page' => $page]) ?>
  <?php snippet('cs-snapshot', ['page' => $page]) ?>

  <article class="cs-article">

    <?php if ($page->problem_intro()->isNotEmpty()): ?>
      <section class="cs-section cs-section--narrative">
        <div class="cs-content-column">
          <h2 class="cs-section-title">The Problem</h2>
          <?= $page->problem_intro()->kt() ?>
        </div>
      </section>
    <?php endif ?>

    <?php if ($page->problem_pullquote()->isNotEmpty()): ?>
      <?php snippet('cs-pullquote', [
        'quote' => $page->problem_pullquote(),
        'attribution' => $page->problem_pullquote_attribution()
      ]) ?>
    <?php endif ?>

    <?php if ($page->why_hard()->isNotEmpty()): ?>
      <section class="cs-section cs-section--narrative">
        <div class="cs-content-column">
          <h2 class="cs-section-title">Why this was hard</h2>
          <?= $page->why_hard()->kt() ?>
        </div>
      </section>
    <?php endif ?>

    <?php if ($page->automations_list()->isNotEmpty()): ?>
      <section class="cs-section cs-section--automations">
        <div class="cs-content-column">
          <h2 class="cs-section-title">What we built</h2>
        </div>
        <div class="cs-automations">
          <?php foreach ($page->automations_list()->toStructure() as $automation): ?>
            <?php snippet('cs-automation-card', ['automation' => $automation]) ?>
          <?php endforeach ?>
        </div>
      </section>
    <?php endif ?>

    <?php if ($page->also_shipped()->isNotEmpty()): ?>
      <section class="cs-section cs-section--narrative cs-section--also-shipped">
        <div class="cs-content-column">
          <h2 class="cs-section-title">Also shipped along the way</h2>
          <?= $page->also_shipped()->kt() ?>
        </div>
      </section>
    <?php endif ?>

    <?php if ($page->results_headline_stat()->isNotEmpty()): ?>
      <?php snippet('cs-stats', ['page' => $page]) ?>
    <?php endif ?>

    <?php if ($page->results_pullquote()->isNotEmpty()): ?>
      <?php snippet('cs-pullquote', [
        'quote' => $page->results_pullquote(),
        'attribution' => $page->results_pullquote_attribution()
      ]) ?>
    <?php endif ?>

    <?php if ($page->human_close_body()->isNotEmpty()): ?>
      <section class="cs-section cs-section--narrative cs-section--human">
        <div class="cs-content-column">
          <h2 class="cs-section-title">What changed for <?= $page->client_person()->or('the client') ?></h2>
          <?= $page->human_close_body()->kt() ?>
        </div>
      </section>
    <?php endif ?>

    <?php if ($page->human_close_pullquote()->isNotEmpty()): ?>
      <?php snippet('cs-pullquote', [
        'quote' => $page->human_close_pullquote(),
        'attribution' => $page->human_close_pullquote_attribution()
      ]) ?>
    <?php endif ?>

    <?php if ($page->collaborator_paragraph()->isNotEmpty()): ?>
      <section class="cs-section cs-section--collaborator">
        <div class="cs-content-column">
          <?= $page->collaborator_paragraph()->kt() ?>
        </div>
      </section>
    <?php endif ?>

    <?php if ($page->video_placeholder_image()->isNotEmpty() || $page->video_url()->isNotEmpty()): ?>
      <section class="cs-section cs-section--video">
        <div class="cs-content-column">
          <h2 class="cs-section-title">Hear it from <?= $page->client_person()->or($page->client_name())->or('the client') ?></h2>
          <?php if ($page->video_status()->toString() === 'Live' && $page->video_url()->isNotEmpty()): ?>
            <div class="cs-video">
              <iframe src="<?= $page->video_url() ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          <?php else: ?>
            <div class="cs-video-placeholder">
              <?php if ($img = $page->video_placeholder_image()->toFile()): ?>
                <img src="<?= $img->url() ?>" alt="Testimonial video coming soon">
              <?php endif ?>
              <div class="cs-video-placeholder__overlay">
                <span class="cs-video-placeholder__play">▶</span>
                <p>Full video coming soon</p>
              </div>
            </div>
          <?php endif ?>
        </div>
      </section>
    <?php endif ?>

    <?php if ($page->tech_stack()->isNotEmpty()): ?>
      <section class="cs-section cs-section--tech">
        <div class="cs-content-column">
          <h3 class="cs-tech-title">Tech Stack</h3>
          <ul class="cs-tech-list">
            <?php foreach ($page->tech_stack()->split(',') as $tech): ?>
              <li><?= trim($tech) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      </section>
    <?php endif ?>

    <section class="cs-section cs-section--cta">
      <div class="cs-content-column">
        <h2 class="cs-cta-headline"><?= $page->cta_headline()->or("Let's build your business a sidecar.") ?></h2>
        <div class="cs-cta-buttons">
          <a href="<?= url('contact') ?>" class="btn btn--cta">Build Something Similar →</a>
        </div>
        <?php if ($page->cta_service_link()->isNotEmpty()): ?>
          <p class="cs-cta-subtext">
            Curious what it costs? <a href="<?= $page->cta_service_link() ?>">Learn about the service →</a>
          </p>
        <?php endif ?>
      </div>
    </section>

  </article>
</main>

<?php snippet('footer') ?>

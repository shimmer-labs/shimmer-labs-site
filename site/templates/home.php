<?php snippet('header') ?>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <div class="hero__wrapper">
      <div class="hero__content">
        <?php if ($page->heroSubheading()->isNotEmpty()): ?>
          <p class="hero__subheading"><?= $page->heroSubheading() ?></p>
        <?php endif ?>
        
        <h1 class="hero__title"><?= $page->heroTitle()->or('Automate Your Business, Reclaim Your Time') ?></h1>
        
        <?php if ($page->heroDescription()->isNotEmpty()): ?>
          <p class="hero__description"><?= $page->heroDescription() ?></p>
        <?php endif ?>
        
        <?php if ($page->heroCta()->isNotEmpty()): ?>
          <a href="<?= $page->heroCtaUrl() ?>" class="btn btn--primary">
            <?= $page->heroCta() ?>
          </a>
        <?php endif ?>
      </div>
      
      <div class="hero__visual">
        <div class="laptop-mockup">
          <?php if ($page->heroLaptopImage()->toFile()): ?>
            <img src="<?= $page->heroLaptopImage()->toFile()->url() ?>" alt="n8n workflow automation" class="laptop-screen">
          <?php endif ?>
        </div>
        <?php if ($page->heroCircleImage()->toFile()): ?>
          <div class="hero__circle-image">
            <img src="<?= $page->heroCircleImage()->toFile()->url() ?>" alt="Automation in action">
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>

<!-- Social Proof -->
<?php snippet('social-proof', ['clients' => $page->clients()]) ?>

<!-- Tools Carousel -->
<?php snippet('tools-carousel') ?>

<!-- Value Proposition -->
<section class="value-prop">
  <div class="container">
    <div class="value-prop__content">
      <?php if ($page->valueTitle()->isNotEmpty()): ?>
        <h2 class="value-prop__title"><?= $page->valueTitle() ?></h2>
      <?php endif ?>
      
      <?= $page->valueDescription()->kt() ?>
    </div>
  </div>
</section>

<!-- Case Study Highlight -->
<?php if ($page->featuredCaseStudy()->isNotEmpty()): ?>
  <?php snippet('case-study-card', ['case' => $page->featuredCaseStudy()->toPage()]) ?>
<?php endif ?>

<!-- Founder Section -->
<?php snippet('founder-intro', [
  'name' => $page->founderName(),
  'title' => $page->founderTitle(),
  'bio' => $page->founderBio(),
  'image' => $page->founderImage()
]) ?>

<!-- Services/Process -->
<section class="services">
  <div class="container">
    <?php if ($page->servicesTitle()->isNotEmpty()): ?>
      <h2 class="services__title"><?= $page->servicesTitle() ?></h2>
    <?php endif ?>
    
    <div class="services__grid">
      <?php foreach ($page->services()->toStructure() as $service): ?>
        <?php snippet('service-card', ['service' => $service]) ?>
      <?php endforeach ?>
    </div>
  </div>
</section>

<!-- Additional Offerings -->
<?php if ($page->additionalOfferings()->isNotEmpty()): ?>
<section class="offerings">
  <div class="container">
    <div class="offerings__grid">
      <?php foreach ($page->additionalOfferings()->toStructure() as $offering): ?>
        <?php snippet('offering-card', ['offering' => $offering]) ?>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<!-- Projects -->
<?php snippet('projects', ['projects' => $page->projects()]) ?>

<!-- Final CTA -->
<section class="cta-final">
  <div class="container">
    <div class="cta-final__content">
      <h2><?= $page->finalCtaTitle()->or("Let's Automate Your Business") ?></h2>
      <?php if ($page->finalCtaDescription()->isNotEmpty()): ?>
        <p><?= $page->finalCtaDescription() ?></p>
      <?php endif ?>
      <a href="<?= $page->finalCtaUrl() ?>" class="btn btn--primary">
        <?= $page->finalCtaText()->or('Get Started') ?>
      </a>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
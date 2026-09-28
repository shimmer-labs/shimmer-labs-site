<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  // SEO-optimized title tags per page.
  // intendedTemplate() returns a Template object; call ->name() for a string.
  $templateName = $page->intendedTemplate()->name();
  $seoTitle = match($templateName) {
    'home' => 'Shimmer Labs | Operations and AI Consultant for Oklahoma Small Businesses',
    'case-studies' => 'Case Studies: Oklahoma Small Businesses That Got Hours Back | Shimmer Labs',
    'case-study' => $page->title() . ' Case Study | Shimmer Labs',
    'projects' => 'Portfolio - SaaS Apps, API Integrations & iOS Development | Shimmer Labs',
    'contact' => 'Start With a Free Snapshot | Shimmer Labs',
    'services' => 'Services & Pricing | Shimmer Labs',
    'service' => $page->seo_title()->or($page->title() . ($page->priceRange()->isNotEmpty() ? ' | ' . $page->priceRange() : ''))->toString() . ' | Shimmer Labs',
    'landing' => $page->seo_title()->or($page->title()) . ' | Shimmer Labs',
    'trade' => $page->seo_title()->or($page->title()) . ' | Shimmer Labs',
    'article' => $page->seo_title()->or($page->title()) . ' | Shimmer Labs',
    'notes' => $page->seo_title()->or($page->title()) . ' | Shimmer Labs',
    'office-hours' => $page->seo_title()->or($page->title()) . ' | Shimmer Labs',
    default => $page->title() . ' | Shimmer Labs'
  };
  ?>
  <title><?= $seoTitle ?></title>

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= url('assets/images/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= url('assets/images/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= url('assets/images/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= url('site.webmanifest') ?>">
  <meta name="msvalidate.01" content="3D0919EE5DF94496ABFA97FF1042B61B">
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">

  <!-- Canonical -->
  <link rel="canonical" href="<?= $page->url() ?>">

  <?php
  // Meta Description with smart fallbacks. Trim to a whole sentence (or word) under 158
  // chars instead of Kirby's excerpt(), which chopped 43 pages mid-sentence with an ellipsis.
  $metaDescription = trim(strip_tags($page->meta_description()->or(
    $page->summary()->or(
      $page->intro()->or(
        $page->mission()->or(
          $page->heroDescription()->or(
            'Fractional operations partner for Oklahoma small businesses. Free snapshot, paid Operations Assessment, and the AI Concierge. Based in Stillwater, OK.'
          )
        )
      )
    )
  )->value()));
  $metaDescription = preg_replace('/\s+/', ' ', $metaDescription);
  if (\Kirby\Toolkit\Str::length($metaDescription) > 158) {
    $cut = \Kirby\Toolkit\Str::substr($metaDescription, 0, 158);
    $end = max((int) strrpos($cut, '. '), (int) strrpos($cut, '? '), (int) strrpos($cut, '! '));
    if ($end > 80) {
      $metaDescription = \Kirby\Toolkit\Str::substr($cut, 0, $end + 1);
    } else {
      $sp = strrpos($cut, ' ');
      $metaDescription = rtrim(\Kirby\Toolkit\Str::substr($cut, 0, $sp ?: 158), ' ,;:');
    }
  }

  // Open Graph image with smart fallbacks. Default is a real 1200x630 card, not the square logo.
  $ogFile = null;
  if ($page->og_image()->toFile()) {
    $ogFile = $page->og_image()->toFile();
  } elseif ($templateName === 'case-study' && $page->hero_image()->toFile()) {
    $ogFile = $page->hero_image()->toFile();
  } elseif ($templateName === 'project' && $page->image()) {
    $ogFile = $page->image();
  } elseif ($templateName === 'trade' && $page->hero_image()->toFile()) {
    $ogFile = $page->hero_image()->toFile();
  }
  if ($ogFile) {
    $ogImage = $ogFile->url();
    $ogWidth = $ogFile->width();
    $ogHeight = $ogFile->height();
  } else {
    $ogImage = url('assets/images/og-default.jpg');
    $ogWidth = 1200;
    $ogHeight = 630;
  }

  // Page-specific OG type
  $ogType = match($templateName) {
    'case-study' => 'article',
    'project' => 'article',
    'article' => 'article',
    default => 'website'
  };
  ?>

  <!-- Meta Description -->
  <meta name="description" content="<?= esc($metaDescription, 'html') ?>">
  <?php if (!empty($noindex)): ?><meta name="robots" content="noindex, follow"><?php endif ?>

  <!-- Open Graph / Social Media Meta Tags -->
  <meta property="og:type" content="<?= $ogType ?>">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:title" content="<?= esc($seoTitle, 'html') ?>">
  <meta property="og:description" content="<?= esc($metaDescription, 'html') ?>">
  <meta property="og:image" content="<?= $ogImage ?>">
  <meta property="og:image:width" content="<?= $ogWidth ?>">
  <meta property="og:image:height" content="<?= $ogHeight ?>">
  <meta property="og:site_name" content="Shimmer Labs">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="<?= $page->url() ?>">
  <meta name="twitter:title" content="<?= esc($seoTitle, 'html') ?>">
  <meta name="twitter:description" content="<?= esc($metaDescription, 'html') ?>">
  <meta name="twitter:image" content="<?= $ogImage ?>">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <?php // Version param busts browser heuristic caching (DO serves last-modified 1980, no max-age) ?>
  <link rel="stylesheet" href="<?= url('assets/css/main.css') ?>?v=<?= substr(md5_file(kirby()->root('index') . '/assets/css/main.css'), 0, 8) ?>">

  <?php snippet('analytics') ?>
  <?php snippet('schema-org') ?>

</head>
<body class="page--<?= $page->intendedTemplate() ?><?= $page->slug() === 'sidecar' ? ' page--sidecar' : '' ?>">
  <header class="site-header">
    <div class="container">
      <nav class="site-nav">
        <a href="<?= $site->url() ?>" class="site-logo">
  <?php if ($site->logo()->toFile()): ?>
    <img src="<?= url('assets/images/shimmer-labs-logo.png') ?>" alt="<?= $site->title() ?>" width="1000" height="1000">
<span class="logo-text"><?= $site->title() ?></span>

  <?php else: ?>
    <span class="logo-text"><?= $site->title() ?></span>
  <?php endif ?>
</a>
        
        <?php $isServicesActive = $page->parent()?->id() === 'services' || $page->id() === 'event-video'; ?>
        <ul class="nav-menu" role="menubar">
          <li class="nav-menu__item nav-menu__item--has-dropdown" role="none">
            <button type="button" class="nav-menu__trigger<?= $isServicesActive ? ' active' : '' ?>" role="menuitem" aria-haspopup="true" aria-expanded="false">
              Services
              <span class="nav-menu__caret" aria-hidden="true">▾</span>
            </button>
            <ul class="nav-dropdown" role="menu">
              <li role="none"><a href="<?= url('services/assessment') ?>" role="menuitem">Operations Assessment</a></li>
              <li role="none"><a href="<?= url('services/concierge') ?>" role="menuitem">AI Concierge</a></li>
              <li role="none"><a href="<?= url('services/sidecar') ?>" role="menuitem">Sidecar</a></li>
              <li role="none"><a href="<?= url('services/custom-apps') ?>" role="menuitem">Custom Apps</a></li>
              <li role="none"><a href="<?= url('services/api-integrations') ?>" role="menuitem">API Integrations</a></li>
              <li role="none"><a href="<?= url('event-video') ?>" role="menuitem">Event Videos</a></li>
            </ul>
          </li>
          <li class="nav-menu__item" role="none">
            <a href="<?= url('case-studies') ?>" role="menuitem" <?php e($page->id() === 'case-studies' || $page->parent()?->id() === 'case-studies', 'class="active"') ?>>Case Studies</a>
          </li>
          <li class="nav-menu__item" role="none">
            <a href="<?= url('about') ?>" role="menuitem" <?php e($page->id() === 'about', 'class="active"') ?>>About</a>
          </li>
          <li class="nav-menu__item" role="none">
            <a href="<?= url('office-hours') ?>" role="menuitem" <?php e($page->id() === 'office-hours', 'class="active"') ?>>Office Hours</a>
          </li>
        </ul>

        <a href="<?= url('contact') ?>" class="nav-cta btn btn--cta">Tell Us What You Need <span aria-hidden="true">&rarr;</span></a>

        <button class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="menuOverlay">
  Menu <span class="menu-icon">≡</span>
</button>
      </nav>
    </div>
  </header>
  <?php snippet('menu-overlay') ?>
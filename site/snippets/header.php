<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  // SEO-optimized title tags per page
  $seoTitle = match($page->intendedTemplate()) {
    'home' => 'Shimmer Labs - Custom Software for Small Businesses | Web Apps, iOS, Shopify',
    'case-studies' => 'Case Studies - Small Business Automation & Custom Software | Shimmer Labs',
    'case-study' => $page->title() . ' Case Study | Shimmer Labs',
    'projects' => 'Portfolio - SaaS Apps, API Integrations & iOS Development | Shimmer Labs',
    'contact' => 'Book a Call - Custom Apps & Software | Shimmer Labs',
    'services' => 'Services & Pricing - Web Apps, APIs, iOS Development | Shimmer Labs',
    'service' => $page->title() . ($page->priceRange()->isNotEmpty() ? ' | ' . $page->priceRange() : '') . ' | Shimmer Labs',
    'landing' => $page->title() . ' | Shimmer Labs',
    default => $page->title() . ' | Shimmer Labs'
  };
  ?>
  <title><?= $seoTitle ?></title>

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= url('assets/images/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= url('assets/images/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= url('assets/images/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= url('site.webmanifest') ?>">
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">

  <?php
  // Meta Description with smart fallbacks
  $metaDescription = $page->meta_description()->or(
    $page->summary()->or(
      $page->intro()->or(
        $page->mission()->or(
          $page->heroDescription()->or(
            'Custom software for small businesses. Web apps, mobile apps, and Shopify solutions — built fast. Based in Stillwater, OK.'
          )
        )
      )
    )
  )->excerpt(160);

  // Open Graph Image with smart fallbacks
  $ogImage = null;
  if ($page->og_image()->toFile()) {
    $ogImage = $page->og_image()->toFile()->url();
  } elseif ($page->intendedTemplate() === 'case-study' && $page->hero_image()->toFile()) {
    $ogImage = $page->hero_image()->toFile()->url();
  } elseif ($page->intendedTemplate() === 'project' && $page->image()) {
    $ogImage = $page->image()->url();
  } else {
    $ogImage = url('assets/images/shimmer-labs-logo.png');
  }

  // Page-specific OG type
  $ogType = match($page->intendedTemplate()) {
    'case-study' => 'article',
    'project' => 'article',
    'service' => 'article',
    default => 'website'
  };
  ?>

  <!-- Meta Description -->
  <meta name="description" content="<?= $metaDescription ?>">

  <!-- Open Graph / Social Media Meta Tags -->
  <meta property="og:type" content="<?= $ogType ?>">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:title" content="<?= $page->title() ?> | Shimmer Labs">
  <meta property="og:description" content="<?= $metaDescription ?>">
  <meta property="og:image" content="<?= $ogImage ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:site_name" content="Shimmer Labs">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="<?= $page->url() ?>">
  <meta name="twitter:title" content="<?= $page->title() ?> | Shimmer Labs">
  <meta name="twitter:description" content="<?= $metaDescription ?>">
  <meta name="twitter:image" content="<?= $ogImage ?>">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <?= css([
    'assets/css/main.css']) ?>

  <?php snippet('analytics') ?>
  <?php snippet('schema-org') ?>

  <!-- Service Worker Registration -->
  <?= js('assets/js/sw-register.js') ?>
</head>
<body class="page--<?= $page->intendedTemplate() ?><?= $page->slug() === 'sidecar' ? ' page--sidecar' : '' ?>">
  <header class="site-header">
    <div class="container">
      <nav class="site-nav">
        <a href="<?= $site->url() ?>" class="site-logo">
  <?php if ($site->logo()->toFile()): ?>
    <img src="<?= url('assets/images/shimmer-labs-logo.png') ?>" alt="<?= $site->title() ?>">
<span class="logo-text"><?= $site->title() ?></span>

  <?php else: ?>
    <span class="logo-text"><?= $site->title() ?></span>
  <?php endif ?>
</a>
        
        <ul class="nav-menu">
          <?php foreach ($site->children()->listed() as $item): ?>
            <li>
              <a href="<?= $item->url() ?>" <?php e($item->isOpen(), 'class="active"') ?>>
                <?= $item->title() ?>
              </a>
            </li>
          <?php endforeach ?>
        </ul>
        
        <button class="menu-toggle" aria-label="Open menu">
  Menu <span class="menu-icon">≡</span>
</button>
      </nav>
    </div>
  </header>
  <?php snippet('menu-overlay') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Open Graph / Social Media Meta Tags -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $site->url() ?>">
<meta property="og:title" content="<?= $page->title() ?> | Shimmer Labs - Business Automation">
<meta property="og:description" content="Automate your business, reclaim your time. Custom automation solutions for small businesses.">
<meta property="og:image" content="<?= url('assets/images/shimmer-labs-logo.png') ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?= $site->url() ?>">
<meta name="twitter:title" content="<?= $page->title() ?> | Shimmer Labs">
<meta name="twitter:description" content="Automate your business, reclaim your time. Custom automation solutions for small businesses.">
<meta name="twitter:image" content="<?= url('assets/images/shimmer-labs-logo.png') ?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page->title() ?> | <?= $site->title() ?></title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <?= css([
    'assets/css/main.css']) ?>
</head>
<body>
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page->title() ?> | <?= $site->title() ?></title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <?= css([
    'assets/css/main.css',
    '@auto'
  ]) ?>
</head>
<body>
  <header class="site-header">
    <div class="container">
      <nav class="site-nav">
        <a href="<?= $site->url() ?>" class="site-logo">
  <?php if ($site->logo()->toFile()): ?>
    <img src="<?= $site->logo()->toFile()->url() ?>" alt="<?= $site->title() ?>">
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
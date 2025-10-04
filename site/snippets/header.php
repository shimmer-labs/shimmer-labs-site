<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <title><?= $page->title() ?> | <?= $site->title() ?></title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="<?= $site->url() ?>">Home</a></li>
        <li><a href="<?= page('services')->url() ?>">Services</a></li>
        <li><a href="<?= page('projects')->url() ?>">Projects</a></li>
        <li><a href="<?= page('contact')->url() ?>">Contact</a></li>
      </ul>
    </nav>
  </header>
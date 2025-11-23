<?php
/**
 * App Store Badge
 *
 * Standard App Store "Download on the App Store" badge
 * Links to App Store or shows "Coming Soon" placeholder
 *
 * Usage: <?php snippet('app-download', [
 *   'url' => 'https://apps.apple.com/app/your-app-id',
 *   'app_name' => 'Your App Name'
 * ]) ?>
 */

$url = $url ?? null;
$app_name = $app_name ?? 'App';
$is_live = $url && method_exists($url, 'isNotEmpty') && $url->isNotEmpty();
$url_string = $is_live ? $url->toString() : '';
?>

<div class="app-download">
  <?php if ($is_live): ?>
    <!-- Live - Link to App Store -->
    <a href="<?= $url_string ?>" class="app-store-badge" target="_blank" rel="noopener" aria-label="Download <?= $app_name ?> on the App Store">
      <img src="<?= url('assets/images/app-store-badge.svg') ?>" alt="Download on the App Store" />
    </a>
  <?php else: ?>
    <!-- Coming Soon Placeholder -->
    <div class="app-store-badge coming-soon">
      <span class="badge-icon">📱</span>
      <div class="badge-text">
        <strong>Coming Soon</strong>
        <span>Available on the App Store</span>
      </div>
    </div>
  <?php endif ?>
</div>

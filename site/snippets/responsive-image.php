<?php
/**
 * Responsive Image Snippet with WebP Support
 *
 * Usage: <?php snippet('responsive-image', [
 *   'image' => $image,
 *   'alt' => 'Description',
 *   'class' => 'custom-class',
 *   'lazy' => true
 * ]) ?>
 */

$image = $image ?? null;
$alt = $alt ?? $image?->alt() ?? '';
$class = $class ?? '';
$lazy = $lazy ?? true;
$sizes = $sizes ?? '100vw';

if (!$image) return;

$imageUrl = $image->url();
$webpUrl = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $imageUrl);
?>

<picture>
  <?php // Try WebP first if it exists ?>
  <?php if (file_exists($image->root() . '.webp')): ?>
    <source
      srcset="<?= $webpUrl ?>"
      type="image/webp"
    >
  <?php endif ?>

  <?php // Fallback to original format ?>
  <img
    <?php if ($lazy): ?>
      data-src="<?= $imageUrl ?>"
      src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
    <?php else: ?>
      src="<?= $imageUrl ?>"
    <?php endif ?>
    alt="<?= $alt ?>"
    class="<?= $class ?>"
    loading="<?= $lazy ? 'lazy' : 'eager' ?>"
    decoding="async"
  >
</picture>

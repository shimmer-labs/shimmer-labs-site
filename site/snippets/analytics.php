<?php
/**
 * Analytics Snippet
 *
 * Supports both Plausible (privacy-friendly) and Google Analytics
 * Configure in site/config/config.php
 */

// Plausible Analytics (Recommended - Privacy-friendly, no cookies)
if (option('analytics.plausible.enabled', false) && option('analytics.plausible.domain')): ?>
<script defer data-domain="<?= option('analytics.plausible.domain') ?>" src="https://plausible.io/js/script.js"></script>
<?php endif ?>

<?php // Google Analytics 4 (GA4)
if (option('analytics.ga4.enabled', false) && option('analytics.ga4.measurementId')): ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= option('analytics.ga4.measurementId') ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?= option('analytics.ga4.measurementId') ?>');
</script>
<?php endif ?>

<?php
  $quote = $quote ?? null;
  $attribution = $attribution ?? null;
  if (!$quote) return;
  $quoteText = is_string($quote) ? $quote : $quote->value();
  $attrText = null;
  if ($attribution) {
    $attrText = is_string($attribution) ? $attribution : (method_exists($attribution, 'isNotEmpty') && $attribution->isNotEmpty() ? $attribution->value() : null);
  }
?>
<figure class="cs-pullquote">
  <div class="container">
    <div class="cs-pullquote__inner">
      <blockquote class="cs-pullquote__quote"><?= $quoteText ?></blockquote>
      <?php if ($attrText): ?>
        <figcaption class="cs-pullquote__attribution"><?= $attrText ?></figcaption>
      <?php endif ?>
    </div>
  </div>
</figure>

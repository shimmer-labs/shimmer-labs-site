<?php
// Website scanner. $variant: 'sidecar' keeps the Sidecar branding, anything else is neutral.
$variant = $variant ?? 'neutral';
$isSidecarVariant = $variant === 'sidecar';
?>
<!-- Website scanner: what should you automate first? -->
<section class="hero hero--inline<?= $isSidecarVariant ? '' : ' hero--inline-neutral' ?>" id="scanner">
  <div class="container">
    <div class="hero__scanner">
      <?php if ($isSidecarVariant): ?>
        <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" class="hero__scanner-logo">
      <?php endif ?>
      <h2 class="hero__title">What should you automate first?</h2>
      <p class="hero__description">Enter your website. We read it and pick the three tasks most worth getting off your plate, each with a prompt you can run this week, a version we build together, and a hands-off option. Free, 15 seconds, no signup.</p>

      <form class="scanner-form" id="scannerForm" action="#" method="POST" novalidate>
        <div class="scanner-form__input-group">
          <input
            type="text"
            name="url"
            id="scannerUrl"
            class="scanner-form__input"
            placeholder="yourwebsite.com"
            required
            inputmode="url"
            autocomplete="off"
            enterkeyhint="go"
          >
          <button type="submit" class="btn <?= $isSidecarVariant ? 'btn--sidecar' : 'btn--cta' ?> scanner-form__button">Scan My Business</button>
        </div>
        <p class="scanner-form__note">Free. Takes 15 seconds. No signup required. <button type="button" class="scanner-form__link" id="scannerNoSite">No website? Describe your business instead.</button></p>

        <div class="scanner-form__describe" id="scannerDescribe" hidden>
          <label for="scannerDescription">Tell us what your business does, in a sentence or two</label>
          <textarea id="scannerDescription" name="description" rows="3" placeholder="We're a two-truck landscaping crew in Stillwater. Mowing, cleanups, and small hardscape jobs. Quotes go out by text and half of them never get followed up."></textarea>
          <button type="submit" class="btn <?= $isSidecarVariant ? 'btn--sidecar' : 'btn--cta' ?> scanner-form__button">Use this instead</button>
        </div>
      </form>

      <div class="scanner-form__loading" id="scannerLoading" style="display: none;">
        <div class="scanner-form__progress-bar"><div class="scanner-form__progress-fill" id="scannerProgressFill"></div></div>
        <p class="scanner-form__loading-text" id="scannerLoadingText">Reading your website...</p>
      </div>

      <p class="scanner-form__error" id="scannerError" style="display: none;"></p>
    </div>
  </div>
</section>

<!-- How the scan works -->
<section class="scanner-how-it-works">
  <div class="container">
    <h2 class="scanner-how-it-works__title">How the scan works</h2>
    <div class="scanner-how-it-works__steps">
      <div class="scanner-how-it-works__step">
        <span class="scanner-how-it-works__number">1</span>
        <p>Enter your website URL</p>
      </div>
      <div class="scanner-how-it-works__step">
        <span class="scanner-how-it-works__number">2</span>
        <p>We read your site and find the tasks eating your week</p>
      </div>
      <div class="scanner-how-it-works__step">
        <span class="scanner-how-it-works__number">3</span>
        <p>You get three tasks, each with a do-it-yourself prompt, a build-it-together plan, and a hands-off option</p>
      </div>
    </div>
    <p class="scanner-how-it-works__cta">Or start with what a typical shop in your trade should automate first:</p>
    <?php if ($auto = page('automate-first')): ?>
    <ul class="trade-chips">
      <?php foreach ($auto->children()->listed() as $t): ?>
        <li><a href="<?= $t->url() ?>"><?= html(preg_replace('/^What should (an? |a small )?(.*?) automate first\?$/i', '$2', $t->title()->value())) ?></a></li>
      <?php endforeach ?>
      <li><a href="<?= $auto->url() ?>" class="trade-chips__all">All trades &rarr;</a></li>
    </ul>
    <?php endif ?>
  </div>
</section>

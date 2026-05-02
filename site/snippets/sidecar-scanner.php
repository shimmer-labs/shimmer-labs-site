<!-- Sidecar Scanner -->
<section class="hero hero--inline" id="scanner">
  <div class="container">
    <div class="hero__scanner">
      <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" class="hero__scanner-logo">
      <h2 class="hero__title">Try the Sidecar scanner.</h2>
      <p class="hero__description">Enter your website. We'll show you what to automate first. Free, 15 seconds, no signup.</p>

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
          <button type="submit" class="btn btn--sidecar scanner-form__button">Scan My Business</button>
        </div>
        <p class="scanner-form__note">Free. Takes 15 seconds. No signup required.</p>
      </form>

      <div class="scanner-form__loading" id="scannerLoading" style="display: none;">
        <div class="scanner-form__progress-bar"><div class="scanner-form__progress-fill" id="scannerProgressFill"></div></div>
        <p class="scanner-form__loading-text" id="scannerLoadingText">Reading your website...</p>
      </div>

      <p class="scanner-form__error" id="scannerError" style="display: none;"></p>
    </div>
  </div>
</section>

<!-- How the Sidecar scanner works -->
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
        <p>We read your site and identify opportunities</p>
      </div>
      <div class="scanner-how-it-works__step">
        <span class="scanner-how-it-works__number">3</span>
        <p>You get a custom hiring plan, 3 agents ready to work</p>
      </div>
    </div>
  </div>
</section>

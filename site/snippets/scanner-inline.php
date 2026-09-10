<?php
// Compact website scanner for content pages. Same element IDs as the full
// block (assets/js/main.js binds to them), so never include both on one page.
?>
<section class="scan-inline" id="scanner">
  <div class="container">
    <div class="scan-inline__box">
      <div class="scan-inline__copy">
        <h2 class="scan-inline__title">What should you automate first?</h2>
        <p class="scan-inline__text">Put your website in. In about 20 seconds you get the three tasks to take off your plate, each with a prompt you can run this week. Free, no signup.</p>
      </div>
      <form class="scanner-form scan-inline__form" id="scannerForm" action="#" method="POST" novalidate>
        <div class="scanner-form__input-group">
          <input type="text" name="url" id="scannerUrl" class="scanner-form__input" placeholder="yourwebsite.com" required inputmode="url" autocomplete="off" enterkeyhint="go">
          <button type="submit" class="btn btn--cta scanner-form__button">Scan My Business</button>
        </div>
        <p class="scanner-form__note"><button type="button" class="scanner-form__link" id="scannerNoSite">No website? Describe your business instead.</button></p>
        <div class="scanner-form__describe" id="scannerDescribe" hidden>
          <label for="scannerDescription">Tell us what your business does, in a sentence or two</label>
          <textarea id="scannerDescription" name="description" rows="3" placeholder="Two-truck plumbing outfit in Perkins. Quotes go out by text and half never get followed up."></textarea>
          <button type="submit" class="btn btn--cta scanner-form__button">Use this instead</button>
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

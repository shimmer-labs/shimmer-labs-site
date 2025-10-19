<?php
/**
 * App Waitlist Form Snippet
 *
 * Displays a waitlist signup form for pre-launch apps
 * Uses Formspree for form handling
 *
 * Usage: <?php snippet('app-waitlist', ['app_name' => 'EventSnag', 'formspree_id' => 'YOUR_ID']) ?>
 */

$app_name = $app_name ?? 'this app';
$formspree_id = $formspree_id ?? null;
$launch_date = $launch_date ?? 'soon';

?>

<?php if ($formspree_id): ?>
<section class="app-waitlist">
  <div class="app-waitlist__container">
    <div class="app-waitlist__header">
      <h2>🚀 Join the Waitlist</h2>
      <p>Be among the first to know when <?= $app_name ?> launches on the App Store.</p>
      <?php if ($launch_date !== 'soon'): ?>
        <p class="app-waitlist__launch-date">
          <strong>Launching:</strong> <?= $launch_date ?>
        </p>
      <?php endif ?>
    </div>

    <?php if (get('waitlist-success')): ?>
      <div class="form-success">
        <p>🎉 You're on the list! We'll email you as soon as <?= $app_name ?> is live.</p>
      </div>
    <?php else: ?>
      <form class="app-waitlist__form" method="POST" action="https://formspree.io/f/<?= $formspree_id ?>">
        <div class="form-row">
          <div class="form-group">
            <label for="waitlist-name">Name</label>
            <input type="text" name="name" id="waitlist-name" required placeholder="Your name">
          </div>

          <div class="form-group">
            <label for="waitlist-email">Email</label>
            <input type="email" name="_replyto" id="waitlist-email" required placeholder="you@example.com">
          </div>
        </div>

        <!-- Hidden fields -->
        <input type="hidden" name="app" value="<?= $app_name ?>">
        <input type="hidden" name="_subject" value="New <?= $app_name ?> Waitlist Signup">
        <input type="hidden" name="_next" value="<?= $page->url() ?>?waitlist-success=true">
        <input type="text" name="_gotcha" style="display:none">

        <button type="submit" class="btn btn--cta">
          Notify Me at Launch
        </button>

        <p class="form-note">We'll only email you when the app is ready. No spam, promise.</p>
      </form>
    <?php endif ?>

    <!-- Social Share Buttons -->
    <div class="app-waitlist__social">
      <p class="app-waitlist__social-label">Help spread the word:</p>
      <div class="social-share-buttons">
        <a href="https://twitter.com/intent/tweet?text=<?= urlencode("Can't wait for " . $app_name . " to launch! 📱 Finally, a way to turn event screenshots into calendar entries. Check it out:") ?>&url=<?= urlencode($page->url()) ?>"
           class="social-share-btn social-share-btn--twitter"
           target="_blank"
           rel="noopener">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
          </svg>
          Share
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($page->url()) ?>"
           class="social-share-btn social-share-btn--linkedin"
           target="_blank"
           rel="noopener">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
          </svg>
          Share
        </a>
      </div>
    </div>
  </div>
</section>
<?php endif ?>

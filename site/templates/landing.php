<?php snippet('header') ?>

<?php if (get('success')): ?>

<!-- ═══════ THANK YOU STATE ═══════ -->
<section class="landing-thankyou">
  <div class="container">
    <div class="landing-thankyou__card">
      <div class="landing-thankyou__icon">✓</div>
      <h1><?= $page->thank_you_title()->or('Check your inbox!') ?></h1>
      <p><?= $page->thank_you_description()->or("We just sent the guide to your email. If you don't see it in a few minutes, check your spam folder.") ?></p>

      <div class="landing-thankyou__ctas">
        <div class="landing-thankyou__cta-card">
          <h3>Free Consultation</h3>
          <p>30 minutes. No pitch, no pressure — just practical advice.</p>
          <a href="https://calendly.com/logan-shimmerlabs/free-consultation" class="btn btn--cta" target="_blank" rel="noopener">Book a Call →</a>
        </div>
        <div class="landing-thankyou__cta-card">
          <h3>Have Questions?</h3>
          <p>Reply to the email we just sent — it goes straight to Logan.</p>
          <a href="mailto:logan@shimmerlabs.co" class="btn btn--primary">Email Us →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php else: ?>

<!-- ═══════ HERO + FORM ═══════ -->
<section class="landing-hero">
  <div class="container">
    <div class="landing-hero__grid">

      <!-- Left: Value Prop -->
      <div class="landing-hero__content">
        <?php if ($page->hero_label()->isNotEmpty()): ?>
          <span class="landing-hero__label"><?= $page->hero_label() ?></span>
        <?php endif ?>

        <h1 class="landing-hero__title"><?= $page->hero_title() ?></h1>

        <?php if ($page->hero_description()->isNotEmpty()): ?>
          <p class="landing-hero__description"><?= $page->hero_description()->kt() ?></p>
        <?php endif ?>

        <?php if ($page->bullets()->isNotEmpty()): ?>
          <div class="landing-hero__bullets">
            <?php if ($page->bullets_title()->isNotEmpty()): ?>
              <h3><?= $page->bullets_title() ?></h3>
            <?php endif ?>
            <ul>
              <?php foreach ($page->bullets()->toStructure() as $bullet): ?>
                <li><?= $bullet->text() ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>

        <?php if ($page->social_proof_text()->isNotEmpty()): ?>
          <p class="landing-hero__proof"><?= $page->social_proof_text() ?></p>
        <?php endif ?>
      </div>

      <!-- Right: Form -->
      <div class="landing-hero__form-wrapper">
        <div class="landing-hero__form-card">
          <?php if ($page->form_heading()->isNotEmpty()): ?>
            <h2><?= $page->form_heading() ?></h2>
          <?php endif ?>
          <?php if ($page->form_subheading()->isNotEmpty()): ?>
            <p class="landing-form__sub"><?= $page->form_subheading() ?></p>
          <?php endif ?>

          <form class="landing-form" id="whitepaper-form">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" placeholder="Jane Smith" required>
            </div>

            <div class="form-group">
              <label for="email">Work Email</label>
              <input type="email" name="email" id="email" placeholder="jane@company.com" required>
            </div>

            <div class="form-group">
              <label for="industry">Industry</label>
              <select name="industry" id="industry" required>
                <option value="" disabled selected>Select your industry</option>
                <option value="Higher Education">Higher Education</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Construction">Construction</option>
                <option value="Professional Services">Professional Services</option>
                <option value="Retail / E-commerce">Retail / E-commerce</option>
                <option value="Nonprofit">Nonprofit</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="form-group">
              <label for="challenge">Biggest Challenge</label>
              <select name="challenge" id="challenge" required>
                <option value="" disabled selected>What's keeping you up at night?</option>
                <option value="Too many manual tasks">Too many manual tasks</option>
                <option value="AI security concerns">AI security / compliance concerns</option>
                <option value="Don't know where to start with AI">Don't know where to start with AI</option>
                <option value="Team is resistant to AI">Team is resistant to AI</option>
                <option value="Need help with AI strategy">Need help building an AI strategy</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <p class="form-error" id="form-error" style="display:none; color:#e74c3c; margin-bottom:1rem;"></p>

            <button type="submit" class="btn btn--cta" id="form-submit"><?= $page->hero_cta()->or('Download the Free Guide →') ?></button>

            <p class="form-note">No spam. Unsubscribe anytime.</p>
          </form>

          <script>
          (function() {
            var form = document.getElementById('whitepaper-form');
            var btn = document.getElementById('form-submit');
            var errEl = document.getElementById('form-error');

            form.addEventListener('submit', function(e) {
              e.preventDefault();
              btn.disabled = true;
              btn.textContent = 'Sending...';
              errEl.style.display = 'none';

              var data = {
                name: form.name.value,
                email: form.email.value,
                industry: form.industry.value,
                challenge: form.challenge.value,
                whitepaper: '<?= $page->whitepaper_slug() ?>',
                source_page: '<?= $page->uri() ?>'
              };

              fetch('https://ckiguztpbsuxnnhabern.supabase.co/functions/v1/whitepaper-webhook', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
              })
              .then(function(res) { return res.json().then(function(j) { return { ok: res.ok, data: j }; }); })
              .then(function(result) {
                if (result.data.ok || result.ok) {
                  window.location.href = '<?= $page->url() ?>?success=true';
                } else {
                  throw new Error(result.data.error || 'Something went wrong');
                }
              })
              .catch(function(err) {
                errEl.textContent = 'Something went wrong. Please try again or email logan@shimmerlabs.co directly.';
                errEl.style.display = 'block';
                btn.disabled = false;
                btn.textContent = '<?= $page->hero_cta()->or('Download the Free Guide →') ?>';
              });
            });
          })();
          </script>
        </div>
      </div>

    </div>
  </div>
</section>

<?php endif ?>

<!-- GA4 Event Tracking -->
<script>
(function() {
  var slug = '<?= $page->whitepaper_slug() ?>';

  <?php if (get('success')): ?>
  // generate_lead — fires on thank you page load
  if (typeof gtag === 'function') {
    gtag('event', 'generate_lead', {
      whitepaper_slug: slug,
      source_page: '<?= $page->uri() ?>'
    });
  }

  // calendly_click — track Calendly CTA clicks
  document.querySelectorAll('a[href*="calendly.com"]').forEach(function(link) {
    link.addEventListener('click', function() {
      if (typeof gtag === 'function') {
        gtag('event', 'calendly_click', {
          whitepaper_slug: slug,
          link_url: this.href
        });
      }
    });
  });

  <?php else: ?>
  // form_start — fires once when user focuses first form field
  var formStarted = false;
  var form = document.querySelector('.landing-form');
  if (form) {
    form.addEventListener('focusin', function() {
      if (!formStarted && typeof gtag === 'function') {
        formStarted = true;
        gtag('event', 'form_start', {
          whitepaper_slug: slug,
          source_page: '<?= $page->uri() ?>'
        });
      }
    });
  }
  <?php endif ?>
})();
</script>

<?php snippet('footer') ?>

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
          <p>30 minutes. No pitch, no pressure, just practical advice.</p>
          <a href="https://api.leadconnectorhq.com/widget/booking/tCHB0sj6MoYpJYWJyVqd" class="btn btn--cta" target="_blank" rel="noopener">Book a Call →</a>
        </div>
        <div class="landing-thankyou__cta-card">
          <h3>Have Questions?</h3>
          <p>Reply to the email we just sent, it goes straight to Logan.</p>
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

        <?php if ($page->summary_text()->isNotEmpty()): ?>
          <div class="landing-hero__summary">
            <h3>What&rsquo;s in the guide</h3>
            <?= $page->summary_text()->kt() ?>
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

          <?php
          $intentLabel   = $page->intent_label()->or('What can we help with?');
          $intentOptions = $page->intent_options()->isNotEmpty()
            ? array_values(array_filter(array_map('trim', explode("\n", $page->intent_options()->value()))))
            : [];
          ?>
          <form class="landing-form" id="whitepaper-form" novalidate>
            <div class="form-group">
              <label for="first_name">First name</label>
              <input type="text" name="first_name" id="first_name" placeholder="Jane" autocomplete="given-name" required>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" placeholder="jane@business.com" autocomplete="email" required>
            </div>

            <div class="form-group">
              <label for="business">Your business (name or website)</label>
              <input type="text" name="business" id="business" placeholder="Acme Plumbing or acmeplumbing.com" autocomplete="organization" required>
            </div>

            <div class="form-group">
              <label for="team_size">Team size</label>
              <select name="team_size" id="team_size" required>
                <option value="" disabled selected>How many of you?</option>
                <option value="Just me">Just me</option>
                <option value="2-10">2-10</option>
                <option value="11-25">11-25</option>
                <option value="26-50">26-50</option>
                <option value="51-100">51-100</option>
                <option value="100+">100+</option>
              </select>
            </div>

            <?php if (!empty($intentOptions)): ?>
            <div class="form-group">
              <label for="intent"><?= esc($intentLabel) ?></label>
              <select name="intent" id="intent" required>
                <option value="" disabled selected>Pick one</option>
                <?php foreach ($intentOptions as $opt): ?>
                  <option value="<?= esc($opt) ?>"><?= esc($opt) ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <?php endif ?>

            <!-- Honeypot: hidden from people, catches bots -->
            <div aria-hidden="true" style="position:absolute; left:-9999px; top:-9999px; height:0; overflow:hidden;">
              <label for="company_url">Company URL</label>
              <input type="text" name="company_url" id="company_url" tabindex="-1" autocomplete="off">
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
            var ctaText = btn.textContent;

            function showError(msg) {
              errEl.textContent = msg;
              errEl.style.display = 'block';
              btn.disabled = false;
              btn.textContent = ctaText;
            }

            form.addEventListener('submit', function(e) {
              e.preventDefault();
              errEl.style.display = 'none';

              // Light client-side guardrails. The server does the real validation.
              if (!form.first_name.value.trim() || !form.email.value.trim() ||
                  !form.business.value.trim() || !form.team_size.value ||
                  (form.intent && !form.intent.value)) {
                showError('Please fill in every field.');
                return;
              }

              btn.disabled = true;
              btn.textContent = 'Sending...';

              var data = {
                first_name: form.first_name.value,
                email: form.email.value,
                business: form.business.value,
                team_size: form.team_size.value,
                intent: form.intent ? form.intent.value : '',
                guide: '<?= $page->whitepaper_slug() ?>',
                source_page: '<?= $page->uri() ?>',
                company_url: form.company_url.value
              };

              fetch('<?= url('_lead') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
              })
              .then(function(res) { return res.json().then(function(j) { return { ok: res.ok, data: j }; }); })
              .then(function(result) {
                if (result.data && result.data.ok) {
                  window.location.href = '<?= $page->url() ?>?success=true';
                } else {
                  showError((result.data && result.data.error) || 'Something went wrong. Please try again or email logan@shimmerlabs.co directly.');
                }
              })
              .catch(function() {
                showError('Something went wrong. Please try again or email logan@shimmerlabs.co directly.');
              });
            });
          })();
          </script>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════ UNGATED CONTENT (SEO + LLM readability) ═══════ -->
<section class="landing-content">
  <div class="container landing-content__inner">

    <?php if ($page->who_for()->isNotEmpty()): ?>
      <div class="landing-content__block">
        <h2>Who this guide is for</h2>
        <?= $page->who_for()->kt() ?>
      </div>
    <?php endif ?>

    <?php if ($page->key_takeaways()->isNotEmpty()): ?>
      <div class="landing-content__block">
        <h2>What you&rsquo;ll take away</h2>
        <ul class="landing-takeaways">
          <?php foreach ($page->key_takeaways()->toStructure() as $t): ?>
            <li>
              <?= $t->text()->kt() ?>
              <?php if ($t->source_name()->isNotEmpty()): ?>
                <span class="landing-takeaways__src">
                  <?php if ($t->source_url()->isNotEmpty()): ?>
                    <a href="<?= $t->source_url() ?>" target="_blank" rel="noopener nofollow">Source: <?= $t->source_name() ?></a>
                  <?php else: ?>
                    Source: <?= $t->source_name() ?>
                  <?php endif ?>
                </span>
              <?php endif ?>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    <?php endif ?>

    <?php if ($page->pull_quote()->isNotEmpty()): ?>
      <blockquote class="landing-pullquote">
        <p><?= $page->pull_quote() ?></p>
        <?php if ($page->pull_quote_attribution()->isNotEmpty()): ?>
          <cite><?= $page->pull_quote_attribution() ?></cite>
        <?php endif ?>
      </blockquote>
    <?php endif ?>

    <?php if ($page->faq()->isNotEmpty()): ?>
      <div class="landing-content__block landing-faq">
        <h2>Questions people ask</h2>
        <?php foreach ($page->faq()->toStructure() as $item): ?>
          <div class="landing-faq__item">
            <h3 class="landing-faq__q"><?= $item->question() ?></h3>
            <div class="landing-faq__a"><?= $item->answer()->kt() ?></div>
          </div>
        <?php endforeach ?>
      </div>
    <?php endif ?>

    <div class="landing-byline">
      <p>Written by <strong>Logan Shimmer</strong>, founder of Shimmer Labs, a software and AI studio in Stillwater, Oklahoma. <a href="<?= url('about') ?>">More about Logan &rarr;</a></p>
    </div>

    <div class="landing-content__cta">
      <a href="#whitepaper-form" class="btn btn--cta">Get the free guide &rarr;</a>
    </div>

  </div>
</section>

<?php endif ?>

<!-- GA4 Event Tracking -->
<script>
(function() {
  var slug = '<?= $page->whitepaper_slug() ?>';

  <?php if (get('success')): ?>
  // generate_lead, fires on thank you page load
  if (typeof gtag === 'function') {
    gtag('event', 'generate_lead', {
      whitepaper_slug: slug,
      source_page: '<?= $page->uri() ?>'
    });
  }

  // book_call click, track consult CTA clicks (GHL booking + legacy Calendly)
  document.querySelectorAll('a[href*="calendly.com"], a[href*="leadconnectorhq.com/widget/booking"]').forEach(function(link) {
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
  // form_start, fires once when user focuses first form field
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

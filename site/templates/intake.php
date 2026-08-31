<?php snippet('header') ?>

<main class="main-content">
<?php if (get('success')): ?>
  <section class="hero hero--compact">
    <div class="container">
      <span class="cs-tag">Got it</span>
      <h1 class="hero__title">Your intake is in.</h1>
      <p class="hero__intro">Logan reads every one of these personally and will text or email you within one business day to set up your first session. A copy just landed in your inbox.</p>
    </div>
  </section>
  <section class="long-form">
    <div class="container">
      <div class="long-form__body" style="text-align:center;">
        <p>No phone trees, no scheduling links, just a person reaching out.</p>
        <p>Can't wait? Come say hi in person: free AI Office Hours, Tuesdays and Thursdays, 2 to 4 PM at <a href="<?= url('office-hours') ?>">WorkIT in Stillwater</a>.</p>
      </div>
    </div>
  </section>
<?php else: ?>
  <section class="hero hero--compact">
    <div class="container">
      <span class="cs-tag">AI Concierge intake</span>
      <h1 class="hero__title"><?= $page->title() ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="hero__intro"><?= $page->intro() ?></p>
      <?php endif ?>
    </div>
  </section>

  <section class="long-form">
    <div class="container">
      <div class="long-form__body">
        <form class="landing-form" id="intake-form" novalidate>
          <div class="form-group">
            <label for="first_name">First name</label>
            <input type="text" name="first_name" id="first_name" placeholder="Jane" autocomplete="given-name" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="jane@business.com" autocomplete="email" required>
          </div>

          <div class="form-group">
            <label for="phone">Phone (we text, we don't spam)</label>
            <input type="tel" name="phone" id="phone" placeholder="(405) 555-0123" autocomplete="tel" required>
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

          <div class="form-group">
            <label for="tasks">What 2 or 3 tasks eat the most of your week?</label>
            <textarea name="tasks" id="tasks" rows="4" placeholder="Invoices into QuickBooks, the monthly schedule, chasing estimates..." required></textarea>
          </div>

          <div class="form-group">
            <label for="pay_to_never">What's the one process you'd pay the most to never do again?</label>
            <textarea name="pay_to_never" id="pay_to_never" rows="3" placeholder="Be honest. This is where we start." required></textarea>
          </div>

          <div class="form-group">
            <label for="tools">What tools does your business run on today? (optional)</label>
            <input type="text" name="tools" id="tools" placeholder="QuickBooks, spreadsheets, paper, Jobber...">
          </div>

          <div class="form-group">
            <label for="tried_ai">What have you already tried with AI? (optional)</label>
            <textarea name="tried_ai" id="tried_ai" rows="2" placeholder="ChatGPT a few times, gave up..."></textarea>
          </div>

          <div class="form-group">
            <label for="tier">How do you prefer to meet?</label>
            <select name="tier" id="tier" required>
              <option value="" disabled selected>Pick one</option>
              <option value="video">Video sessions</option>
              <option value="in-person">In person (we're in Stillwater and get around Oklahoma)</option>
            </select>
          </div>

          <!-- Honeypot: hidden from people, catches bots -->
          <div aria-hidden="true" style="position:absolute; left:-9999px; top:-9999px; height:0; overflow:hidden;">
            <label for="company_url">Company URL</label>
            <input type="text" name="company_url" id="company_url" tabindex="-1" autocomplete="off">
          </div>

          <p class="form-error" id="form-error" style="display:none; color:#e74c3c; margin-bottom:1rem;"></p>

          <button type="submit" class="btn btn--cta" id="form-submit">Send my intake →</button>

          <p class="form-note">The AI Concierge is $1,000/mo. Right now the next 5 clients get $750/mo, locked in, because we're trying something new. Logan reads every submission personally. No spam, no drip campaigns you didn't ask for.</p>
        </form>
      </div>
    </div>
  </section>

  <script>
  (function () {
    var form = document.getElementById('intake-form');
    if (!form) return;
    var btn = document.getElementById('form-submit');
    var errEl = document.getElementById('form-error');
    function showError(msg) {
      errEl.textContent = msg;
      errEl.style.display = 'block';
      btn.disabled = false;
      btn.textContent = 'Send my intake →';
    }
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      errEl.style.display = 'none';
      var required = ['first_name', 'email', 'phone', 'business', 'team_size', 'tasks', 'pay_to_never', 'tier'];
      for (var i = 0; i < required.length; i++) {
        if (!form[required[i]].value.trim()) {
          showError('Please fill in every required field.');
          return;
        }
      }
      btn.disabled = true;
      btn.textContent = 'Sending…';
      var data = {
        first_name: form.first_name.value,
        email: form.email.value,
        phone: form.phone.value,
        business: form.business.value,
        team_size: form.team_size.value,
        tasks: form.tasks.value,
        pay_to_never: form.pay_to_never.value,
        tools: form.tools.value,
        tried_ai: form.tried_ai.value,
        tier: form.tier.value,
        source_page: '<?= $page->uri() ?>',
        company_url: form.company_url.value
      };
      fetch('<?= url('_intake') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      }).then(function (r) {
        return r.json().then(function (j) { return { ok: r.ok, data: j }; });
      }).then(function (result) {
        if (result.ok && result.data.ok) {
          window.location = '<?= $page->url() ?>?success=true';
        } else {
          showError(result.data.error || 'Something went wrong. Please email logan@shimmerlabs.co.');
        }
      }).catch(function () {
        showError('Network hiccup. Please try again or email logan@shimmerlabs.co.');
      });
    });
  })();
  </script>
<?php endif ?>
</main>

<?php if (get('success')): ?>
<script>
  if (typeof gtag === 'function') {
    gtag('event', 'generate_lead', { form: 'concierge_intake' });
  }
</script>
<?php endif ?>

<?php snippet('footer') ?>

<?php snippet('header', ['noindex' => true]) ?>

<style>
  .scan-results {
    padding: 3rem 0 4rem;
    min-height: 60vh;
  }
  .scan-results__header {
    text-align: center;
    margin-bottom: 2.5rem;
  }
  .scan-results__logo {
    width: 100px;
    height: auto;
    margin-bottom: 1rem;
  }
  .scan-results__title {
    font-family: var(--font-heading);
    font-size: 2rem;
    color: var(--color-navy);
    margin-bottom: 0.25rem;
  }
  .scan-results__subtitle {
    color: var(--color-gray-medium);
    font-size: 1.1rem;
  }

  .scan-results__rescan {
    display: inline-block;
    font-size: 0.85rem;
    color: var(--color-sidecar);
    text-decoration: none;
    margin-top: 0.5rem;
  }
  .scan-results__rescan:hover {
    text-decoration: underline;
  }

  /* Company banner (slim) */
  .scan-company {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
    background: var(--color-sidecar-light);
    border: 1px solid var(--color-sidecar-border);
    border-radius: 8px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
  }
  .scan-company__name {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    color: var(--color-navy);
    margin-bottom: 0;
  }
  .scan-company__badge {
    display: inline-block;
    background: var(--color-sidecar);
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.15rem 0.6rem;
    border-radius: 100px;
    text-transform: capitalize;
  }
  .scan-company__description {
    color: var(--color-gray-medium);
    font-size: 0.9rem;
    line-height: 1.5;
    flex-basis: 100%;
  }

  /* Mid-page CTA (mobile) */
  .scan-mid-cta {
    text-align: center;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    background: var(--color-sidecar-light);
    border: 1px solid var(--color-sidecar-border);
    border-radius: 8px;
  }
  .scan-mid-cta p {
    font-weight: 600;
    color: var(--color-navy);
    margin-bottom: 0.75rem;
  }

  /* Inline form error */
  .scan-cta__form-error {
    color: #e74c3c;
    font-size: 0.85rem;
    margin: 0;
  }

  /* Agent cards */
  .scan-agents {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    max-width: 1000px;
    margin: 0 auto 3rem;
  }
  .scan-agent-card {
    background: white;
    border: 2px solid var(--color-gray-light);
    border-radius: 12px;
    padding: 2rem;
    transition: border-color 0.2s;
  }
  .scan-agent-card:hover {
    border-color: var(--color-sidecar-border);
  }
  .scan-agent-card__icon {
    font-size: 2rem;
    margin-bottom: 0.75rem;
  }
  .scan-agent-card__title {
    font-family: var(--font-heading);
    font-size: 1.25rem;
    color: var(--color-navy);
    margin-bottom: 0.75rem;
  }
  .scan-agent-card__section-label {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--color-sidecar);
    margin-bottom: 0.5rem;
    margin-top: 1.25rem;
  }
  .scan-agent-card__responsibilities {
    list-style: none;
    padding: 0;
  }
  .scan-agent-card__responsibilities li {
    position: relative;
    padding-left: 1.25rem;
    margin-bottom: 0.4rem;
    font-size: 0.95rem;
    color: var(--color-navy);
    line-height: 1.5;
  }
  .scan-agent-card__responsibilities li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.55rem;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--color-sidecar);
  }
  .scan-agent-card__tools {
    font-size: 0.9rem;
    color: var(--color-gray-medium);
    line-height: 1.5;
  }
  .scan-agent-card__schedule {
    font-size: 0.9rem;
    color: var(--color-gray-medium);
    font-style: italic;
  }
  .scan-agent-card__pain-point {
    margin-bottom: 1rem;
    padding: 0.75rem 1rem;
    background: #FFF9E6;
    border: 1px solid #D4A017;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    color: #8B6914;
    line-height: 1.4;
  }

  /* CTA section */
  .scan-cta {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
    background: var(--color-sidecar-light);
    border: 1px solid var(--color-sidecar-border);
    border-radius: 12px;
    padding: 2.5rem 2rem;
  }
  .scan-cta__title {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    color: var(--color-navy);
    margin-bottom: 0.5rem;
  }
  .scan-cta__subtitle {
    color: var(--color-gray-medium);
    margin-bottom: 1.5rem;
  }
  .scan-cta__form {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    max-width: 360px;
    margin: 0 auto 1rem;
  }
  .scan-cta__input {
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    border: 2px solid var(--color-gray-light);
    border-radius: var(--border-radius);
    outline: none;
    font-family: var(--font-body);
    box-sizing: border-box;
  }
  .scan-cta__input:focus {
    border-color: var(--color-sidecar);
  }
  .scan-cta__form .btn {
    width: 100%;
  }
  .scan-cta__or {
    color: var(--color-gray-medium);
    margin: 1rem 0;
    font-size: 0.9rem;
  }

  /* Success state */
  .scan-cta__success {
    display: none;
  }
  .scan-cta__success h3 {
    font-family: var(--font-heading);
    color: var(--color-navy);
    margin-bottom: 0.5rem;
  }
  .scan-cta__success p {
    color: var(--color-gray-medium);
    margin-bottom: 1rem;
  }

  /* Loading state */
  .scan-loading {
    text-align: center;
    padding: 6rem 0;
    min-height: 60vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  .scan-loading__spinner {
    width: 48px;
    height: 48px;
    border: 3px solid var(--color-gray-light);
    border-top-color: var(--color-sidecar);
    border-radius: 50%;
    animation: scanner-spin 0.8s linear infinite;
    margin-bottom: 1.5rem;
  }

  /* Error state */
  .scan-error {
    text-align: center;
    padding: 6rem 0;
    min-height: 60vh;
  }
  .scan-error__title {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    color: var(--color-navy);
    margin-bottom: 0.5rem;
  }
  .scan-error__message {
    color: var(--color-gray-medium);
    margin-bottom: 1.5rem;
  }

  /* Level badge + ladder + prompt block */
  .scan-agent-card__top { display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; margin-bottom: 0.5rem; }
  .scan-level-badge { font-size: 0.75rem; font-weight: 700; letter-spacing: 0.02em; padding: 0.3rem 0.65rem; border-radius: 999px; white-space: nowrap; }
  .scan-level-badge--prompt { background: #E8F7EE; color: #1B6B3A; }
  .scan-level-badge--project { background: #FFF4DB; color: #8A5A00; }
  .scan-level-badge--built { background: #FFE9DD; color: #9A3E0F; }
  .scan-ladder { list-style: none; margin: 0 0 1.25rem; padding: 0; display: grid; gap: 0.5rem; }
  .scan-ladder__rung { display: grid; grid-template-columns: 1fr; gap: 0.3rem; padding: 0.65rem 0.85rem; border: 1px solid var(--color-gray-light); border-radius: 8px; font-size: 0.9rem; line-height: 1.45; opacity: 0.8; }
  .scan-ladder__rung--active { opacity: 1; border-color: var(--color-gold); background: #FFFBEF; }
  .scan-ladder__label { font-weight: 700; color: var(--color-navy); display: flex; align-items: baseline; gap: 0.5rem; flex-wrap: wrap; }
  .scan-ladder__label small { font-weight: 400; color: var(--color-gray-medium); font-size: 0.78rem; }
  .scan-ladder__text { color: #374151; }
  .scan-prompt { position: relative; margin-bottom: 1.25rem; }
  .scan-prompt__text { white-space: pre-wrap; font-family: inherit; font-size: 0.9rem; line-height: 1.55; background: #F6F7F9; border: 1px solid var(--color-gray-light); border-radius: 8px; padding: 1rem 1rem 2.6rem; margin: 0; color: #111827; }
  .scan-prompt__copy { position: absolute; right: 0.6rem; bottom: 0.6rem; font-size: 0.8rem; font-weight: 600; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid var(--color-navy); background: white; color: var(--color-navy); cursor: pointer; }
  .scan-prompt__copy:hover { background: var(--color-navy); color: white; }
  .scan-agent-card__meta { font-size: 0.85rem; color: var(--color-gray-medium); margin: 0; }
  .scan-next { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin: 1.5rem 0 2rem; text-align: left; }
  .scan-next__card { display: flex; flex-direction: column; gap: 0.4rem; padding: 1.25rem; border: 2px solid var(--color-gray-light); border-radius: 12px; background: white; color: var(--color-navy); text-decoration: none; font-size: 0.9rem; line-height: 1.45; transition: border-color 0.2s, transform 0.2s; }
  .scan-next__card:hover { border-color: var(--color-gold); transform: translateY(-2px); }
  .scan-next__card--primary { border-color: var(--color-gold); background: #FFFBEF; }
  .scan-next__card strong { font-size: 1.05rem; }
  .scan-next__card span:last-child { color: #4B5563; }
  .scan-next__icon { font-size: 1.5rem; }

  @media (max-width: 768px) {
    .scan-agents {
      grid-template-columns: 1fr;
    }
    .scan-next { grid-template-columns: 1fr; }
    .scan-results__title {
      font-size: 1.5rem;
    }
  }
</style>

<!-- Loading state -->
<section class="scan-loading" id="scanLoading">
  <div class="container">
    <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" style="width: 100px; margin-bottom: 1.5rem;">
    <div class="scan-loading__spinner"></div>
    <p class="scanner-form__loading-text" id="scanPageLoadingText">Loading your results...</p>
  </div>
</section>

<!-- Error state -->
<section class="scan-error" id="scanError" style="display: none;">
  <div class="container">
    <h2 class="scan-error__title">Something went wrong</h2>
    <p class="scan-error__message" id="scanErrorMessage">We couldn't load your scan results.</p>
    <a href="/" class="btn btn--sidecar">Try Again</a>
  </div>
</section>

<!-- Results -->
<section class="scan-results" id="scanResults" style="display: none;">
  <div class="container">

    <div class="scan-results__header">
      <h1 class="scan-results__title" id="scanResultsTitle">What to take off your plate first</h1>
      <p class="scan-results__subtitle">Three tasks, three ways to do each one. Start where you groan.</p>
      <a href="/services/concierge#scanner" class="scan-results__rescan">Scan another business</a>
    </div>

    <!-- Company profile banner -->
    <div class="scan-company" id="scanCompany"></div>

    <!-- Agent cards -->
    <div class="scan-agents" id="scanAgents"></div>

    <!-- Mid-page CTA (inserted by JS between cards on mobile) -->
    <div class="scan-mid-cta" id="scanMidCta" style="display: none;">
      <p>Want a hand with these?</p>
      <a href="<?= url('office-hours') ?>" class="btn btn--cta" data-scan-cta="office_hours">Bring them to free office hours</a>
    </div>

    <!-- Next steps -->
    <div class="scan-cta" id="scanCta">
      <h2 class="scan-cta__title">Three ways to take the next step</h2>
      <div class="scan-next">
        <a href="<?= url('office-hours') ?>" class="scan-next__card" data-scan-cta="office_hours">
          <span class="scan-next__icon">☕</span>
          <strong>Bring it to office hours</strong>
          <span>Free. Tuesdays and Thursdays, 2 to 4 PM at WorkIT in Stillwater. Bring one of these, leave with it automated.</span>
        </a>
        <a href="<?= url('intake') ?>" class="scan-next__card scan-next__card--primary" id="scanIntakeLink" data-scan-cta="intake">
          <span class="scan-next__icon">🤝</span>
          <strong>Start the AI Concierge intake</strong>
          <span>Two working sessions a month, built with you on your screen. Your three tasks are already filled in.</span>
        </a>
        <a href="<?= url('services/sidecar') ?>" class="scan-next__card" data-scan-cta="sidecar">
          <span class="scan-next__icon">🏍️</span>
          <strong>Have us build and run it</strong>
          <span>Sidecar, for the always-on tasks that have to fire while you sleep. Built for you, hosted by us.</span>
        </a>
      </div>

      <p class="scan-cta__subtitle">Want this in your inbox so you can find it later?</p>
      <form class="scan-cta__form" id="scanLeadForm">
        <input type="text" name="name" placeholder="Your name" class="scan-cta__input">
        <input type="email" name="email" placeholder="you@company.com" class="scan-cta__input" required>
        <p class="scan-cta__form-error" id="scanFormError" style="display: none;"></p>
        <button type="submit" class="btn btn--cta">Email me this plan</button>
      </form>

      <div class="scan-cta__success" id="scanCtaSuccess">
        <h3>Check your inbox!</h3>
        <p>We sent the plan, prompts included. Reply to that email and it lands with Logan.</p>
      </div>
    </div>

  </div>
</section>

<script>
(function() {
  // Localhost: talk to scanner directly. Prod: same-origin proxy
  var isLocal = <?= $_SERVER['SERVER_NAME'] === 'localhost' ? 'true' : 'false' ?>;
  var SCANNER_API = isLocal ? 'http://localhost:3001' : '';
  var SCAN_PATH = isLocal ? '/api/scan/' : '/_scan/';
  var INTAKE_BASE = '<?= url('intake') ?>';
  var LEVELS = ['prompt', 'project', 'built'];
  var LEVEL_LABEL = { prompt: 'Do it yourself this week', project: 'Build it together', built: 'Have it built and run' };
  var LEVEL_HINT = { prompt: 'A prompt you can run today', project: 'One or two concierge sessions', built: 'Sidecar builds and runs it' };

  var params = new URLSearchParams(window.location.search);
  var scanId = params.get('id');

  var loadingEl = document.getElementById('scanLoading');
  var errorEl = document.getElementById('scanError');
  var resultsEl = document.getElementById('scanResults');
  var errorMsgEl = document.getElementById('scanErrorMessage');

  if (!scanId) {
    showError('No scan ID provided. Go back and scan your business.');
    return;
  }

  // Fetch scan results
  fetch(SCANNER_API + SCAN_PATH + scanId)
    .then(function(res) {
      if (!res.ok) throw new Error('Scan not found');
      return res.json();
    })
    .then(function(data) {
      renderResults(data);
      // GA4 event
      if (typeof gtag === 'function') {
        gtag('event', 'scan_completed', {
          scan_id: scanId,
          industry: data.industry
        });
      }
    })
    .catch(function(err) {
      showError(err.message || 'Could not load scan results. Please try again.');
    });

  function showError(msg) {
    loadingEl.style.display = 'none';
    errorMsgEl.textContent = msg;
    errorEl.style.display = 'block';
  }

  function renderResults(scan) {
    loadingEl.style.display = 'none';
    resultsEl.style.display = 'block';

    // Title
    if (scan.company_name) {
      document.getElementById('scanResultsTitle').textContent = scan.company_name + ': what to take off your plate first';
    }
    document.getElementById('scanIntakeLink').href = INTAKE_BASE + '?scan=' + encodeURIComponent(scanId);

    // Company card
    var companyHtml = '';
    if (scan.company_name) {
      companyHtml += '<h3 class="scan-company__name">' + escapeHtml(scan.company_name) + '</h3>';
    }
    if (scan.industry) {
      companyHtml += '<span class="scan-company__badge">' + escapeHtml(scan.industry.replace(/_/g, ' ')) + '</span>';
    }
    if (scan.company_description) {
      companyHtml += '<p class="scan-company__description">' + escapeHtml(scan.company_description) + '</p>';
    }
    document.getElementById('scanCompany').innerHTML = companyHtml;

    // Task cards
    var agents = scan.agents || [];
    var agentsHtml = '';
    agents.forEach(function(agent, idx) {
      var level = LEVELS.indexOf(agent.level) !== -1 ? agent.level : 'project';
      agentsHtml += '<div class="scan-agent-card scan-agent-card--' + level + '">';
      agentsHtml += '<div class="scan-agent-card__top"><div class="scan-agent-card__icon">' + (agent.icon || '✅') + '</div>';
      agentsHtml += '<span class="scan-level-badge scan-level-badge--' + level + '">' + escapeHtml(LEVEL_LABEL[level]) + '</span></div>';
      agentsHtml += '<h3 class="scan-agent-card__title">' + escapeHtml(agent.title) + '</h3>';

      if (agent.pain_point) {
        agentsHtml += '<div class="scan-agent-card__pain-point">' + escapeHtml(agent.pain_point) + '</div>';
      }

      if (agent.responsibilities && agent.responsibilities.length) {
        agentsHtml += '<p class="scan-agent-card__section-label">What it takes care of</p>';
        agentsHtml += '<ul class="scan-agent-card__responsibilities">';
        agent.responsibilities.forEach(function(r) {
          agentsHtml += '<li>' + escapeHtml(r) + '</li>';
        });
        agentsHtml += '</ul>';
      }

      // The ladder
      agentsHtml += '<p class="scan-agent-card__section-label">Three ways to get it off your plate</p>';
      agentsHtml += '<ol class="scan-ladder">';
      var rungText = {
        prompt: level === 'prompt' ? 'Start with the prompt below.' : 'A lighter version you can run by hand with the prompt below.',
        project: agent.together || 'We set it up together in a working session so it runs the same way every time.',
        built: agent.built || 'The always-on version runs without you.'
      };
      LEVELS.forEach(function(key) {
        var on = key === level;
        agentsHtml += '<li class="scan-ladder__rung' + (on ? ' scan-ladder__rung--active' : '') + '">';
        agentsHtml += '<span class="scan-ladder__label">' + escapeHtml(LEVEL_LABEL[key]) + '<small>' + escapeHtml(LEVEL_HINT[key]) + '</small></span>';
        agentsHtml += '<span class="scan-ladder__text">' + escapeHtml(rungText[key]) + '</span>';
        agentsHtml += '</li>';
      });
      agentsHtml += '</ol>';

      if (agent.diy_prompt) {
        agentsHtml += '<p class="scan-agent-card__section-label">Copy this into ChatGPT or Claude</p>';
        agentsHtml += '<div class="scan-prompt"><pre class="scan-prompt__text" id="scanPrompt' + idx + '">' + escapeHtml(agent.diy_prompt) + '</pre>';
        agentsHtml += '<button type="button" class="scan-prompt__copy" data-copy="scanPrompt' + idx + '">Copy prompt</button></div>';
      }

      var meta = [];
      if (agent.tools && agent.tools.length) meta.push('<strong>Works with:</strong> ' + agent.tools.map(escapeHtml).join(', '));
      if (agent.estimated_time_saved) meta.push('<strong>Time back:</strong> ' + escapeHtml(agent.estimated_time_saved));
      if (meta.length) agentsHtml += '<p class="scan-agent-card__meta">' + meta.join(' &middot; ') + '</p>';

      agentsHtml += '</div>';
    });
    document.getElementById('scanAgents').innerHTML = agentsHtml;

    // Copy-prompt buttons
    document.querySelectorAll('.scan-prompt__copy').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var pre = document.getElementById(btn.getAttribute('data-copy'));
        var text = pre ? pre.textContent : '';
        var done = function() {
          btn.textContent = 'Copied';
          setTimeout(function() { btn.textContent = 'Copy prompt'; }, 2000);
          if (typeof gtag === 'function') gtag('event', 'scan_prompt_copied', { scan_id: scanId });
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(text).then(done, function() { fallbackCopy(text); done(); });
        } else { fallbackCopy(text); done(); }
      });
    });
    function fallbackCopy(text) {
      var ta = document.createElement('textarea');
      ta.value = text; document.body.appendChild(ta); ta.select();
      try { document.execCommand('copy'); } catch (e) {}
      document.body.removeChild(ta);
    }

    // Next-step tracking
    document.querySelectorAll('[data-scan-cta]').forEach(function(link) {
      link.addEventListener('click', function() {
        if (typeof gtag === 'function') gtag('event', 'scan_next_step', { scan_id: scanId, step: link.getAttribute('data-scan-cta') });
      });
    });

    // Show mid-CTA on mobile (between agent cards 2 and 3)
    if (window.innerWidth <= 768 && agents.length >= 3) {
      var agentCards = document.querySelectorAll('.scan-agent-card');
      var midCta = document.getElementById('scanMidCta');
      if (agentCards.length >= 2 && midCta) {
        agentCards[1].after(midCta);
        midCta.style.display = 'block';
      }
    }

    // Lead form
    var leadForm = document.getElementById('scanLeadForm');
    var ctaSection = document.getElementById('scanCta');
    var successSection = document.getElementById('scanCtaSuccess');
    var formError = document.getElementById('scanFormError');

    leadForm.addEventListener('submit', function(e) {
      e.preventDefault();
      var email = leadForm.email.value;
      var name = leadForm.name.value;
      formError.style.display = 'none';

      var btn = leadForm.querySelector('button');
      btn.disabled = true;
      btn.textContent = 'Sending...';

      fetch(SCANNER_API + SCAN_PATH + scanId + '/lead', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email, name: name })
      })
      .then(function(res) { return res.json(); })
      .then(function(data) {
        if (data.error) {
          formError.textContent = data.message || 'Something went wrong.';
          formError.style.display = 'block';
          btn.disabled = false;
          btn.textContent = 'Email me this plan';
          return;
        }
        leadForm.style.display = 'none';
        ctaSection.querySelector('.scan-cta__subtitle').style.display = 'none';
        successSection.style.display = 'block';

        if (typeof gtag === 'function') {
          gtag('event', 'scan_email_captured', { scan_id: scanId });
        }
      })
      .catch(function() {
        formError.textContent = 'Something went wrong. Please try again.';
        formError.style.display = 'block';
        btn.disabled = false;
        btn.textContent = 'Email me this plan';
      });
    });
  }

  function escapeHtml(str) {
    if (!str) return '';
    var div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }
})();
</script>

<?php snippet('footer') ?>

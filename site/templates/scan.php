<?php snippet('header') ?>

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

  /* Company card */
  .scan-company {
    background: var(--color-sidecar-light);
    border: 1px solid var(--color-sidecar-border);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2.5rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
  }
  .scan-company__name {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    color: var(--color-navy);
    margin-bottom: 0.5rem;
  }
  .scan-company__badge {
    display: inline-block;
    background: var(--color-sidecar);
    color: white;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 0.25rem 0.75rem;
    border-radius: 100px;
    margin-bottom: 0.75rem;
    text-transform: capitalize;
  }
  .scan-company__description {
    color: var(--color-gray-medium);
    line-height: 1.6;
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

  @media (max-width: 768px) {
    .scan-agents {
      grid-template-columns: 1fr;
    }
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
      <img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" class="scan-results__logo">
      <h1 class="scan-results__title" id="scanResultsTitle">Your AI Agent Team</h1>
      <p class="scan-results__subtitle">Here's who we'd hire for your business.</p>
    </div>

    <!-- Company profile card -->
    <div class="scan-company" id="scanCompany"></div>

    <!-- Agent cards -->
    <div class="scan-agents" id="scanAgents"></div>

    <!-- CTA -->
    <div class="scan-cta" id="scanCta">
      <h2 class="scan-cta__title">Get your full plan emailed to you</h2>
      <p class="scan-cta__subtitle">We'll send these agent descriptions plus next steps.</p>

      <form class="scan-cta__form" id="scanLeadForm">
        <input type="text" name="name" placeholder="Your name" class="scan-cta__input">
        <input type="email" name="email" placeholder="you@company.com" class="scan-cta__input" required>
        <button type="submit" class="btn btn--sidecar">Send My Plan</button>
      </form>

      <p class="scan-cta__or">or</p>

      <a href="" class="btn btn--primary" id="scanCalendlyLink" target="_blank" rel="noopener">Book a Free Discovery Call</a>

      <div class="scan-cta__success" id="scanCtaSuccess">
        <h3>Check your inbox!</h3>
        <p>We sent your full plan. In the meantime:</p>
        <a href="" class="btn btn--sidecar" id="scanCalendlyLinkSuccess" target="_blank" rel="noopener">Book a Free Discovery Call</a>
      </div>
    </div>

  </div>
</section>

<script>
(function() {
  var SCANNER_API = '<?= $_SERVER['SERVER_NAME'] === 'localhost' ? 'http://localhost:3001' : 'https://scanner.shimmerlabs.co' ?>';
  var CALENDLY_BASE = 'https://calendly.com/logan-shimmerlabs/sidecar-discovery';

  var params = new URLSearchParams(window.location.search);
  var scanId = params.get('id');

  var loadingEl = document.getElementById('scanLoading');
  var errorEl = document.getElementById('scanError');
  var resultsEl = document.getElementById('scanResults');
  var errorMsgEl = document.getElementById('scanErrorMessage');

  if (!scanId) {
    showError('No scan ID provided. Go back to the homepage and scan your business.');
    return;
  }

  // Fetch scan results
  fetch(SCANNER_API + '/api/scan/' + scanId)
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
      document.getElementById('scanResultsTitle').textContent = scan.company_name + "'s AI Agent Team";
    }

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

    // Agent cards
    var agents = scan.agents || [];
    var agentsHtml = '';
    agents.forEach(function(agent) {
      agentsHtml += '<div class="scan-agent-card">';
      agentsHtml += '<div class="scan-agent-card__icon">' + (agent.icon || '🤖') + '</div>';
      agentsHtml += '<h3 class="scan-agent-card__title">' + escapeHtml(agent.title) + '</h3>';

      if (agent.responsibilities && agent.responsibilities.length) {
        agentsHtml += '<p class="scan-agent-card__section-label">Responsibilities</p>';
        agentsHtml += '<ul class="scan-agent-card__responsibilities">';
        agent.responsibilities.forEach(function(r) {
          agentsHtml += '<li>' + escapeHtml(r) + '</li>';
        });
        agentsHtml += '</ul>';
      }

      if (agent.tools && agent.tools.length) {
        agentsHtml += '<p class="scan-agent-card__section-label">Tools & Integrations</p>';
        agentsHtml += '<p class="scan-agent-card__tools">' + agent.tools.map(escapeHtml).join(', ') + '</p>';
      }

      if (agent.schedule) {
        agentsHtml += '<p class="scan-agent-card__section-label">Schedule</p>';
        agentsHtml += '<p class="scan-agent-card__schedule">' + escapeHtml(agent.schedule) + '</p>';
      }

      agentsHtml += '</div>';
    });
    document.getElementById('scanAgents').innerHTML = agentsHtml;

    // Calendly links
    var calendlyUrl = CALENDLY_BASE + '?a1=scan-' + scanId;
    document.getElementById('scanCalendlyLink').href = calendlyUrl;
    document.getElementById('scanCalendlyLinkSuccess').href = calendlyUrl;

    // Lead form
    var leadForm = document.getElementById('scanLeadForm');
    var ctaSection = document.getElementById('scanCta');
    var successSection = document.getElementById('scanCtaSuccess');

    leadForm.addEventListener('submit', function(e) {
      e.preventDefault();
      var email = leadForm.email.value;
      var name = leadForm.name.value;

      var btn = leadForm.querySelector('button');
      btn.disabled = true;
      btn.textContent = 'Sending...';

      // Update Calendly links with email/name
      var calUrl = CALENDLY_BASE + '?email=' + encodeURIComponent(email) + '&name=' + encodeURIComponent(name) + '&a1=scan-' + scanId;
      document.getElementById('scanCalendlyLink').href = calUrl;
      document.getElementById('scanCalendlyLinkSuccess').href = calUrl;

      fetch(SCANNER_API + '/api/scan/' + scanId + '/lead', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email, name: name })
      })
      .then(function(res) { return res.json(); })
      .then(function() {
        leadForm.style.display = 'none';
        ctaSection.querySelector('.scan-cta__title').style.display = 'none';
        ctaSection.querySelector('.scan-cta__subtitle').style.display = 'none';
        ctaSection.querySelector('.scan-cta__or').style.display = 'none';
        document.getElementById('scanCalendlyLink').style.display = 'none';
        successSection.style.display = 'block';

        if (typeof gtag === 'function') {
          gtag('event', 'scan_email_captured', { scan_id: scanId });
        }
      })
      .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Send My Plan';
        alert('Something went wrong. Please try again.');
      });
    });

    // Calendly click tracking
    document.querySelectorAll('[id^="scanCalendly"]').forEach(function(link) {
      link.addEventListener('click', function() {
        if (typeof gtag === 'function') {
          gtag('event', 'scan_calendly_clicked', { scan_id: scanId });
        }
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

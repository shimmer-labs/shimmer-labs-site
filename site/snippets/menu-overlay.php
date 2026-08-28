<div class="menu-overlay" id="menuOverlay" style="display: none;" role="dialog" aria-modal="true" aria-label="Site navigation">
  <div class="menu-card">
    <button class="menu-close" aria-label="Close menu">
      Close ✕
    </button>

    <div class="menu-content">
      <!-- Services -->
      <div class="menu-section">
        <h3>Services</h3>
        <ul class="menu-links">
          <li>
            <a href="<?= url('services/custom-apps') ?>">
              <span class="menu-link-icon">⚡</span>
              <span class="menu-link-title">Custom Apps</span>
              <span class="menu-link-price">Web from $15k · iOS from $20k</span>
            </a>
          </li>
          <li>
            <a href="<?= url('services/sidecar') ?>" class="menu-link--sidecar">
              <span class="menu-link-icon"><img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="" style="width: 24px; height: 24px; display: inline-block; vertical-align: middle;"></span>
              <span class="menu-link-title">Sidecar, AI Agents</span>
              <span class="menu-link-price">from $250/mo</span>
            </a>
          </li>
          <li>
            <a href="<?= url('services/concierge') ?>">
              <span class="menu-link-icon">🤝</span>
              <span class="menu-link-title">AI Concierge</span>
              <span class="menu-link-price">from $750/mo</span>
            </a>
          </li>
          <li>
            <a href="<?= url('services/api-integrations') ?>">
              <span class="menu-link-icon">🔌</span>
              <span class="menu-link-title">API Integrations</span>
              <span class="menu-link-price">$2,500 – $7,000</span>
            </a>
          </li>
          <li>
            <a href="<?= url('event-video') ?>">
              <span class="menu-link-icon">🎬</span>
              <span class="menu-link-title">Event Videos</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- For Your Trade -->
      <div class="menu-section">
        <h3>For Your Trade</h3>
        <ul class="menu-links">
          <li>
            <a href="<?= url('landscapers') ?>">
              <span class="menu-link-icon">🌱</span>
              <span class="menu-link-title">Landscapers</span>
            </a>
          </li>
          <li>
            <a href="<?= url('plumbers') ?>">
              <span class="menu-link-icon">🔧</span>
              <span class="menu-link-title">Plumbers &amp; HVAC</span>
            </a>
          </li>
          <li>
            <a href="<?= url('roofers') ?>">
              <span class="menu-link-icon">🏠</span>
              <span class="menu-link-title">Roofers</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Case Studies -->
      <div class="menu-section">
        <h3>Case Studies</h3>
        <ul class="menu-links">
          <li>
            <a href="<?= url('case-studies') ?>" class="menu-link-all">See all case studies →</a>
          </li>
        </ul>
      </div>

      <!-- About -->
      <div class="menu-section">
        <h3>About</h3>
        <ul class="menu-links">
          <li>
            <a href="<?= url('about') ?>">
              <span class="menu-link-title">About Shimmer Labs</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Office Hours -->
      <div class="menu-section">
        <h3>Office Hours</h3>
        <ul class="menu-links">
          <li>
            <a href="<?= url('office-hours') ?>">
              <span class="menu-link-icon">🤖</span>
              <span class="menu-link-title">AI Office Hours</span>
              <span class="menu-link-price">Tue &amp; Thu, 2–4 PM</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Contact CTA -->
      <div class="menu-footer">
        <a href="<?= url('contact') ?>" class="menu-contact-link">Tell Us What You Need →</a>
      </div>
    </div>
  </div>
</div>

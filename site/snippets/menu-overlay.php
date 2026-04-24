<div class="menu-overlay" id="menuOverlay" style="display: none;">
  <div class="menu-card">
    <!-- Close button -->
    <button class="menu-close" aria-label="Close menu">
      Close ✕
    </button>

    <div class="menu-content">
      <!-- Services Section -->
      <div class="menu-section">
        <h3>Services</h3>
        <ul class="menu-links">
          <li>
            <a href="/services/sidecar" class="menu-link--sidecar">
              <span class="menu-link-icon"><img src="<?= url('assets/images/sidecar-logo-nobg.png') ?>" alt="Sidecar" style="width: 24px; height: 24px; display: inline-block; vertical-align: middle;"></span>
              <span class="menu-link-title">Sidecar — AI Agents</span>
            </a>
          </li>
          <li>
            <a href="/services/custom-apps">
              <span class="menu-link-icon">⚡</span>
              <span class="menu-link-title">Custom Apps</span>
              <span class="menu-link-price">from $25k</span>
            </a>
          </li>
          <li>
            <a href="/services/api-integrations">
              <span class="menu-link-icon">🔌</span>
              <span class="menu-link-title">API Integrations</span>
              <span class="menu-link-price">$3.5k - $12k</span>
            </a>
          </li>
          <li>
            <a href="/event-video">
              <span class="menu-link-icon">🎬</span>
              <span class="menu-link-title">Event Videos</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Case Studies Section -->
      <div class="menu-section">
        <h3>Case Studies</h3>
        <ul class="menu-links">
          <?php
          if ($caseStudiesPage = page('case-studies')) {
            // Featured items in specific order
            $featuredSlugs = ['sweat-yoga-fitness', 'eventsnag', 'paidly', 'treebidpro'];

            foreach ($featuredSlugs as $slug) {
              if ($item = $caseStudiesPage->find($slug)) {
                if ($item->badge() == 'Coming Soon' || $item->badge() == 'Launching Soon') {
                  echo '<li class="coming-soon"><span>' . $item->title() . '</span> <small>(' . $item->badge() . ')</small></li>';
                } else {
                  echo '<li><a href="' . $item->url() . '">' . $item->title() . '</a></li>';
                }
              }
            }

            echo '<li><a href="' . $caseStudiesPage->url() . '" class="menu-link-all">All Case Studies →</a></li>';
          }
          ?>
        </ul>
      </div>

      <!-- Events Section -->
      <div class="menu-section">
        <h3>Events</h3>
        <ul class="menu-links">
          <li>
            <a href="/office-hours">
              <span class="menu-link-icon">🤖</span>
              <span class="menu-link-title">AI Office Hours</span>
              <span class="menu-link-price">Tue & Thu, 2–4 PM</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Contact Footer -->
      <div class="menu-footer">
        <a href="/contact" class="menu-contact-link">Contact Us</a>
      </div>
    </div>
  </div>
</div>
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
        </ul>
      </div>

      <!-- Projects Section -->
      <div class="menu-section">
        <h3>Projects</h3>
        <ul class="menu-links">
          <?php
          if ($projectsPage = page('projects')) {
            // Featured projects in specific order
            $featuredSlugs = ['eventsnag', 'paidly', 'treebidpro'];

            foreach ($featuredSlugs as $slug) {
              if ($project = $projectsPage->find($slug)) {
                if ($project->badge() == 'Coming Soon' || $project->badge() == 'Launching Soon') {
                  echo '<li class="coming-soon"><span>' . $project->title() . '</span> <small>(' . $project->badge() . ')</small></li>';
                } else {
                  echo '<li><a href="' . $project->url() . '">' . $project->title() . '</a></li>';
                }
              }
            }

            // All Projects link
            echo '<li><a href="' . $projectsPage->url() . '" class="menu-link-all">All Projects →</a></li>';
          }
          ?>
        </ul>
      </div>

      <!-- Office Hours -->
      <div class="menu-section">
        <h3>Events</h3>
        <div class="menu-office-hours">
          <img src="<?= url('assets/images/office.jpg') ?>" alt="Shimmer Labs office" class="menu-office-hours__photo">
          <div class="menu-office-hours__details">
            <span class="menu-office-hours__title">🤖 AI Office Hours</span>
            <span class="menu-office-hours__schedule">Tue &amp; Thu, 2–4 PM</span>
            <span class="menu-office-hours__address">901 S. Main St, Stillwater, OK</span>
            <span class="menu-office-hours__note">Bring your questions. Come hang.</span>
            <span class="menu-office-hours__cal-links">
              <a href="https://calendar.google.com/calendar/event?action=TEMPLATE&tmeid=MHQ5YWMxbHY4N2E4NHIzdjB1OG9lZ2VyNzFfMjAyNjA0MTRUMTkwMDAwWiBsb2dhbkBzaGltbWVybGFicy5jbw&tmsrc=logan%40shimmerlabs.co&scp=ALL" target="_blank" class="menu-office-hours__cta">Add Tue →</a>
              <a href="https://calendar.google.com/calendar/event?action=TEMPLATE&tmeid=MnVnb290aGU3cjBjaDNvMzE2bXRhNjFzMXYgbG9nYW5Ac2hpbW1lcmxhYnMuY28&tmsrc=logan%40shimmerlabs.co" target="_blank" class="menu-office-hours__cta">Add Thu →</a>
            </span>
          </div>
        </div>
      </div>

      <!-- Contact Footer -->
      <div class="menu-footer">
        <a href="/contact" class="menu-contact-link">Contact Us</a>
      </div>
    </div>
  </div>
</div>
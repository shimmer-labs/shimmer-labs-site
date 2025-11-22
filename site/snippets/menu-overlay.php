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
          <?php if ($homePage = page('home')): ?>
            <?php foreach ($homePage->packages()->toStructure() as $package): ?>
              <li>
                <a href="<?= $package->link() ?>">
                  <span class="menu-link-icon"><?= $package->icon() ?></span>
                  <span class="menu-link-title"><?= $package->title() ?></span>
                  <span class="menu-link-price"><?= $package->price() ?></span>
                </a>
              </li>
            <?php endforeach ?>
          <?php endif ?>
        </ul>
      </div>

      <!-- Projects Section -->
      <div class="menu-section">
        <h3>Projects</h3>
        <ul class="menu-links">
          <?php
          if ($projectsPage = page('projects')) {
            // Featured projects in specific order
            $featuredSlugs = ['eventsnag', 'paidly', 'n8n_taddy_api_nodes'];

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

      <!-- Contact Footer -->
      <div class="menu-footer">
        <a href="/contact" class="menu-contact-link">Contact Us</a>
      </div>
    </div>
  </div>
</div>
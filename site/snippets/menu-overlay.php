<div class="menu-overlay" id="menuOverlay" style="display: none;">
  <div class="menu-card">
    <!-- Close button -->
    <button class="menu-close" aria-label="Close menu">
      Close ✕
    </button>
    
    <div class="menu-grid">
      <!-- Left side: Projects list -->
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
            echo '<li><a href="' . $projectsPage->url() . '" style="font-weight: 500; margin-top: 8px;">All Projects...</a></li>';
          }
          ?>
        </ul>
      </div>
      
      <!-- Right side: CTA -->
      <div class="menu-cta">
        <h2>
          Ready to invest in automation? 
          <span class="highlight">It starts here.</span>
          Get in touch to start a conversation.
        </h2>
        <a href="/contact" class="cta-button">Contact Us</a>
      </div>
    </div>
  </div>
</div>
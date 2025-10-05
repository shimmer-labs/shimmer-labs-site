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
            foreach ($projectsPage->children()->listed() as $project) {
              if ($project->badge() == 'Coming Soon') {
                echo '<li class="coming-soon"><span>' . $project->title() . '</span> <small>(Coming Soon)</small></li>';
              } else {
                echo '<li><a href="' . $project->url() . '">' . $project->title() . '</a></li>';
              }
            }
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
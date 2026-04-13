<footer class="site-footer">
  <div class="container">
    <div class="footer-content">
      <div class="footer-brand">
        <a href="<?= $site->url() ?>" class="footer-logo">
          <img src="<?= url('assets/images/shimmer-labs-logo.png') ?>" alt="Shimmer Labs">
        </a>
        <p class="footer-tagline">Let's build something.</p>
      </div>

      <div class="footer-links">
        <div class="footer-col">
          <h4>Services</h4>
          <ul>
            <li><a href="<?= url('services/sidecar') ?>">Sidecar (AI Agents)</a></li>
            <li><a href="<?= url('services/custom-apps') ?>">Custom Apps</a></li>
            <li><a href="<?= url('services/api-integrations') ?>">API Integrations</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Company</h4>
          <ul>
            <li><a href="<?= url('about') ?>">About</a></li>
            <li><a href="<?= url('projects') ?>">Projects</a></li>
            <li><a href="<?= url('office-hours') ?>">AI Office Hours</a></li>
            <li><a href="<?= url('lunch-learn') ?>">Lunch &amp; Learn</a></li>
            <li><a href="<?= url('contact') ?>">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Connect</h4>
          <ul>
            <li><a href="mailto:logan@shimmerlabs.co">logan@shimmerlabs.co</a></li>
            <li><a href="https://www.linkedin.com/in/loganshimmer/" target="_blank" rel="noopener">LinkedIn</a></li>
            <li><a href="https://www.instagram.com/shimmer.labs/" target="_blank" rel="noopener">Instagram</a></li>
            <li><a href="https://github.com/shimmer-labs" target="_blank" rel="noopener">GitHub</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> Shimmer Labs. All rights reserved.</p>
    </div>
  </div>
</footer>

<?= js(['assets/js/main.js']) ?>
</body>
</html>
<footer class="site-footer">
  <div class="container">
    <div class="footer-content">
      <div class="footer-brand">
        <a href="<?= $site->url() ?>" class="footer-logo">
          <img src="<?= url('assets/images/shimmer-labs-logo.png') ?>" alt="Shimmer Labs">
        </a>
        <p class="footer-tagline">Let's automate your business.</p>
      </div>

      <div class="footer-links">
        <div class="footer-col">
          <h4>Services</h4>
          <ul>
            <li><a href="<?= url('services/api-wrappers') ?>">API Wrappers</a></li>
            <li><a href="<?= url('services/business-automation') ?>">Business Automation</a></li>
            <li><a href="<?= url('services/n8n-workflows') ?>">n8n Workflows</a></li>
            <li><a href="<?= url('services/saas-integrations') ?>">SaaS Integrations</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Company</h4>
          <ul>
            <li><a href="<?= url('about') ?>">About</a></li>
            <li><a href="<?= url('projects') ?>">Projects</a></li>
            <li><a href="<?= url('contact') ?>">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Connect</h4>
          <ul>
            <li><a href="mailto:logan@shimmerlabs.co">logan@shimmerlabs.co</a></li>
            <li><a href="https://linkedin.com/in/loganherr" target="_blank" rel="noopener">LinkedIn</a></li>
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
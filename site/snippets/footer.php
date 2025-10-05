<footer class="site-footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-brand">
          <a href="<?= $site->url() ?>" class="footer-logo">
            <?php if ($site->logo()->isNotEmpty()): ?>
              <img src="<?= url('assets/images/shimmer-labs-logo.png') ?>" alt="<?= $site->title() ?>">
            <?php else: ?>
              <span class="logo-text"><?= $site->title() ?></span>
            <?php endif ?>
          </a>
          <p class="footer-tagline"><?= $site->tagline()->or('Let\'s automate your business.') ?></p>
        </div>
        
        <div class="footer-links">
          <div class="footer-col">
            <h4>Services</h4>
            <ul>
              <li><a href="/services">Business Automation</a></li>
              <li><a href="/services">Custom Integrations</a></li>
              <li><a href="/services">n8n Workflows</a></li>
              <li><a href="/services">Lifecycle Marketing</a></li>
            </ul>
          </div>
          
          <div class="footer-col">
            <h4>Company</h4>
            <ul>
              <li><a href="/about">About</a></li>
              <li><a href="/case-studies">Case Studies</a></li>
              <li><a href="/contact">Contact</a></li>
            </ul>
          </div>
          
          <div class="footer-col">
            <h4>Connect</h4>
            <ul>
              <?php if ($site->email()->isNotEmpty()): ?>
                <li><a href="mailto:<?= $site->email() ?>"><?= $site->email() ?></a></li>
              <?php endif ?>
              <?php if ($site->linkedin()->isNotEmpty()): ?>
                <li><a href="<?= $site->linkedin() ?>" target="_blank">LinkedIn</a></li>
              <?php endif ?>
              <?php if ($site->twitter()->isNotEmpty()): ?>
                <li><a href="<?= $site->twitter() ?>" target="_blank">Twitter</a></li>
              <?php endif ?>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> <?= $site->title() ?>. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <?= js([
    'assets/js/main.js',
    '@auto'
  ]) ?></body>
</html>
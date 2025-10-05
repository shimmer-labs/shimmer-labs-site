<?php snippet('header') ?>

<section class="contact-section">
  <div class="container">
    <div class="contact-content">
      <div class="contact-header">
        <h1>Let's Build Something</h1>
        <p>Tell us about your workflow headaches. We'll show you how automation can fix them.</p>
      </div>

      <?php if (get('success')): ?>
        <div class="form-success">
          <p>Thanks! We'll get back to you within 24 hours.</p>
        </div>
      <?php else: ?>

      <form class="contact-form" method="POST" action="https://formspree.io/f/mwprqqyj">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="_replyto" id="email" required>
          </div>
        </div>

        <div class="form-group">
          <label for="company">Company (optional)</label>
          <input type="text" name="company" id="company">
        </div>

        <div class="form-group">
          <label for="message">What are you spending too much time on?</label>
          <textarea name="message" id="message" rows="6" required placeholder="Data entry, customer onboarding, inventory sync..."></textarea>
        </div>

        <input type="hidden" name="_next" value="https://shimmerlabs.co/contact?success">
        <input type="text" name="_gotcha" style="display:none">

        <button type="submit" class="btn btn--cta">Let's Talk Automation</button>
        
        <p class="form-note">We'll get back to you within 24 hours. Usually faster.</p>
      </form>

      <?php endif ?>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
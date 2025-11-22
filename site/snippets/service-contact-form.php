<section class="service-contact-form">
  <div class="container">
    <div class="service-contact-form__content">
      <div class="service-contact-form__header">
        <h2><?= $ctaTitle ?? "Ready to Get Started?" ?></h2>
        <?php if (!empty($ctaDescription)): ?>
          <p><?= $ctaDescription ?></p>
        <?php else: ?>
          <p>Tell us about your project and we'll get back to you within 24 hours with a detailed proposal.</p>
        <?php endif ?>
      </div>

      <?php if (get('success')): ?>
        <div class="form-success">
          <p>Thanks! We'll review your project details and get back to you within 24 hours.</p>
        </div>
      <?php else: ?>

      <form class="contact-form" method="POST" action="https://formspree.io/f/xdkwjykz" accept-charset="UTF-8">
        <input type="hidden" name="service" value="<?= $page->title() ?>">

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
          <label for="message">Tell us about your project</label>
          <textarea name="message" id="message" rows="6" required placeholder="What are you trying to build? Do you have designs already? What's your timeline?"></textarea>
        </div>

        <input type="text" name="_gotcha" style="display:none">

        <button type="submit" class="btn btn--cta">Send Project Details →</button>

        <p class="form-note">We'll get back to you within 24 hours. Usually faster.</p>
      </form>

      <?php endif ?>
    </div>
  </div>
</section>

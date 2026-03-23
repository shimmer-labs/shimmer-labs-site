<section class="service-contact-form">
  <div class="container">
    <div class="service-contact-form__content">
      <div class="service-contact-form__header">
        <h2><?= $ctaTitle ?? "Ready to Get Started?" ?></h2>
        <?php if (!empty($ctaDescription)): ?>
          <p><?= $ctaDescription ?></p>
        <?php else: ?>
          <p>Book a quick call. We'll give you a straight answer on cost and timeline.</p>
        <?php endif ?>
      </div>

      <div class="calendly-inline-widget"
           data-url="https://calendly.com/logan-shimmerlabs/30min?background_color=ffffff&text_color=0a1a2f&primary_color=fdbe34"
           style="min-width:320px;height:700px;">
      </div>
      <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
    </div>
  </div>
</section>

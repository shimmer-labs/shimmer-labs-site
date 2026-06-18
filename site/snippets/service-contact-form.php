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

      <!-- GHL booking widget (Consultation calendar) -->
      <iframe src="https://api.leadconnectorhq.com/widget/booking/tCHB0sj6MoYpJYWJyVqd"
              style="width:100%; min-height:700px; border:none; overflow:hidden;"
              scrolling="no" id="ghl-booking-service" title="Book a free consultation with Shimmer Labs"></iframe>
      <script src="https://link.msgsndr.com/js/form_embed.js" type="text/javascript"></script>
    </div>
  </div>
</section>

<?php snippet('header') ?>

<section class="contact-section">
  <div class="container">
    <div class="contact-content">
      <div class="contact-header">
        <h1>Let's Build Something</h1>
        <p>Book a quick call. Tell us what you need built, we'll give you a straight answer on cost and timeline.</p>
      </div>

      <!-- Location & Contact Info -->
      <div class="contact-location">
        <div class="contact-location__grid">
          <div class="contact-location__card">
            <div class="contact-location__label">Office</div>
            <p>
              WorkIT Coworking Center<br>
              901 S. Main St<br>
              Stillwater, OK 74074
            </p>
            <a href="https://maps.google.com/?q=901+S+Main+St+Stillwater+OK" target="_blank" rel="noopener" class="contact-location__link">Get Directions &rarr;</a>
          </div>
          <div class="contact-location__card">
            <div class="contact-location__label">Drop In</div>
            <p>
              <a href="/office-hours">AI Office Hours</a><br>
              Tuesdays &amp; Thursdays, 2&ndash;4 PM<br>
              Free. No appointment needed.
            </p>
          </div>
          <div class="contact-location__card">
            <div class="contact-location__label">Email</div>
            <p>
              <a href="mailto:logan@shimmerlabs.co">logan@shimmerlabs.co</a>
            </p>
          </div>
          <div class="contact-location__card">
            <div class="contact-location__label">Call</div>
            <p>
              <a href="tel:+14058806674">(405) 880-6674</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Map -->
      <section class="local-map local-map--contact">
        <div class="local-map__embed">
          <iframe
            src="https://www.google.com/maps?q=Shimmer+Labs,901+S+Main+St+Suite+86,Stillwater,OK+74074&output=embed"
            width="100%"
            height="380"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Map of Shimmer Labs at WorkIT, 901 S Main St Suite 86, Stillwater, OK">
          </iframe>
        </div>
      </section>

      <!-- Calendly transition -->
      <div class="contact-calendly-intro">
        <p>Want to talk it through first? Grab 30 minutes and we'll figure out what makes sense.</p>
      </div>

      <!-- GHL booking widget (Consultation calendar) -->
      <iframe src="https://api.leadconnectorhq.com/widget/booking/tCHB0sj6MoYpJYWJyVqd"
              style="width:100%; min-height:700px; border:none; overflow:hidden;"
              scrolling="no" id="ghl-booking-contact" title="Book a free consultation with Shimmer Labs"></iframe>
      <script src="https://link.msgsndr.com/js/form_embed.js" type="text/javascript"></script>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
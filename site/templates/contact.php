<?php snippet('header') ?>

<section class="contact-section">
  <div class="container">
    <div class="contact-content">
      <div class="contact-header">
        <h1>Tell us what's eating your week</h1>
        <p>Start with a free Snapshot: office hours, a 30-minute call, or the scanner. Three questions and you leave with the five tasks eating your week and the first move. If there's more than one thing to fix, the <a href="<?= url('services/assessment') ?>">Operations Assessment</a> comes next.</p>
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
              Tuesdays &amp; Thursdays, 2&ndash;3 PM<br>
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

      <!-- Snapshot call -->
      <div class="contact-calendly-intro">
        <p><strong>Book the free Snapshot call.</strong> Thirty minutes. Bring the task you hate most. We'll tell you plainly whether it's a prompt you can run yourself, an Operations Assessment, or the AI Concierge, or none of the above.</p>
        <p>Prefer to skip the call? <a href="<?= url('intake') ?>">Fill out the intake form</a> and pick where you want to start. Logan replies within a business day.</p>
      </div>

      <!-- GHL booking widget (Consultation calendar) -->
      <iframe src="https://api.leadconnectorhq.com/widget/booking/tCHB0sj6MoYpJYWJyVqd"
              style="width:100%; min-height:700px; border:none; overflow:hidden;"
              scrolling="no" id="ghl-booking-contact" title="Book a free Snapshot call with Shimmer Labs"></iframe>
      <script src="https://link.msgsndr.com/js/form_embed.js" type="text/javascript"></script>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
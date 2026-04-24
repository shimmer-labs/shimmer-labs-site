<?php snippet('header') ?>

<style>
/* ═══════ Lunch & Learn Event Page ═══════ */
.ll-walkaway,
.ll-signup,
.ll-presenter {
  position: relative;
  z-index: 2;
}
.ll-hero {
  background: linear-gradient(135deg, #503AA8 0%, #7c4ddb 50%, #9B51E0 100%);
  padding: 4rem 0 3rem;
  position: relative;
  overflow: hidden;
}
.ll-hero::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; bottom: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
  background-size: 60px 60px;
}
.ll-hero .container { position: relative; z-index: 1; }
.ll-hero__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
}
.ll-hero__badge {
  display: inline-block;
  background: rgba(253,190,52,0.15);
  color: #FDBE34;
  font-size: 0.85rem;
  font-weight: 600;
  padding: 0.35rem 1rem;
  border-radius: 100px;
  border: 1px solid rgba(253,190,52,0.3);
  margin-bottom: 1.25rem;
  font-family: var(--font-body);
  letter-spacing: 0.02em;
}
.ll-hero__title {
  font-family: var(--font-heading);
  font-size: 2.5rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.15;
  margin-bottom: 1.5rem;
}
.ll-hero__title span { color: #FDBE34; }
.ll-hero__details {
  list-style: none;
  padding: 0;
  margin: 0 0 2rem;
}
.ll-hero__details li {
  color: rgba(255,255,255,0.9);
  font-size: 1.05rem;
  padding: 0.4rem 0;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}
.ll-hero__details .ll-icon {
  width: 20px;
  text-align: center;
  flex-shrink: 0;
}
.ll-hero__flyer {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  border: 3px solid rgba(255,255,255,0.15);
}
.ll-hero__flyer img {
  width: 100%;
  height: auto;
  display: block;
}
.ll-hero__scroll-cta {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: #FDBE34;
  color: #0A1A2F;
  font-weight: 700;
  font-size: 1.1rem;
  padding: 0.9rem 2rem;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s;
  font-family: var(--font-heading);
}
.ll-hero__scroll-cta:hover {
  background: #ffe066;
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(253,190,52,0.4);
}

/* Walk Away With */
.ll-walkaway {
  padding: 4rem 0;
  background: #FBFAF3;
  overflow: visible;
}
.ll-walkaway h2 {
  font-family: var(--font-heading);
  font-size: 2rem;
  color: #0A1A2F;
  text-align: center;
  margin-bottom: 2.5rem;
}
.ll-walkaway__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.25rem;
}
.ll-walkaway__card {
  background: #fff;
  border-radius: 12px;
  padding: 1.5rem;
  border-left: 4px solid #FDBE34;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
  transition: transform 0.2s;
}
.ll-walkaway__card:hover { transform: translateY(-3px); }
.ll-walkaway__card .card-num {
  display: inline-block;
  background: rgba(253,190,52,0.15);
  color: #503AA8;
  font-weight: 700;
  font-size: 0.85rem;
  width: 28px; height: 28px;
  line-height: 28px;
  text-align: center;
  border-radius: 50%;
  margin-bottom: 0.75rem;
}
.ll-walkaway__card p {
  color: #0A1A2F;
  font-size: 0.95rem;
  line-height: 1.5;
  margin: 0;
}

/* Signup Section */
.ll-signup {
  padding: 4rem 0;
  background: #fff;
}
.ll-signup__grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 3rem;
  align-items: start;
}
.ll-signup__form-card {
  background: #FBFAF3;
  border-radius: 16px;
  padding: 2.5rem;
  border: 1px solid rgba(80,58,168,0.12);
}
.ll-signup__form-card h2 {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  color: #0A1A2F;
  margin-bottom: 0.5rem;
}
.ll-signup__form-card .form-sub {
  color: #6B7280;
  margin-bottom: 1.75rem;
  font-size: 0.95rem;
}
.ll-form .form-group {
  margin-bottom: 1.25rem;
}
.ll-form label {
  display: block;
  font-weight: 600;
  font-size: 0.85rem;
  color: #0A1A2F;
  margin-bottom: 0.35rem;
}
.ll-form input,
.ll-form textarea {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 1rem;
  font-family: var(--font-body);
  transition: border-color 0.2s;
  background: #fff;
}
.ll-form input:focus,
.ll-form textarea:focus {
  outline: none;
  border-color: #9B51E0;
  box-shadow: 0 0 0 3px rgba(155,81,224,0.1);
}
.ll-form textarea {
  resize: vertical;
  min-height: 70px;
}
.ll-form .form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}
.ll-form .ll-submit {
  width: 100%;
  padding: 0.9rem;
  background: linear-gradient(135deg, #503AA8, #9B51E0);
  color: #fff;
  font-weight: 700;
  font-size: 1.05rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s;
  font-family: var(--font-heading);
  margin-top: 0.5rem;
}
.ll-form .ll-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(155,81,224,0.3);
}
.ll-form .ll-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}
.ll-form .form-note {
  text-align: center;
  color: #6B7280;
  font-size: 0.8rem;
  margin-top: 0.75rem;
}
.ll-form .form-error {
  background: #fef2f2;
  border: 1px solid #fecaca;
  color: #dc2626;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

/* Sidebar Info */
.ll-signup__info h3 {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  color: #0A1A2F;
  margin-bottom: 1.25rem;
}
.ll-info-card {
  background: #FBFAF3;
  border-radius: 12px;
  padding: 1.25rem 1.5rem;
  margin-bottom: 1rem;
  border: 1px solid rgba(0,0,0,0.06);
}
.ll-info-card .info-label {
  font-weight: 600;
  font-size: 0.8rem;
  color: #9B51E0;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 0.35rem;
}
.ll-info-card p {
  color: #0A1A2F;
  font-size: 0.95rem;
  line-height: 1.5;
  margin: 0;
}
.ll-info-card a {
  color: #503AA8;
  text-decoration: underline;
}

/* Presenter */
.ll-presenter {
  padding: 3.5rem 0;
  background: #0A1A2F;
  color: #fff;
}
.ll-presenter__inner {
  max-width: 700px;
  margin: 0 auto;
  text-align: center;
}
.ll-presenter h2 {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  margin-bottom: 1.25rem;
}
.ll-presenter h2 span { color: #FDBE34; }
.ll-presenter p {
  color: rgba(255,255,255,0.8);
  font-size: 1rem;
  line-height: 1.7;
  margin-bottom: 1rem;
}
.ll-presenter .presenter-cred {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  justify-content: center;
  margin-top: 1.5rem;
}
.ll-presenter .cred-tag {
  background: rgba(253,190,52,0.12);
  color: #FDBE34;
  font-size: 0.8rem;
  font-weight: 600;
  padding: 0.35rem 0.85rem;
  border-radius: 100px;
  border: 1px solid rgba(253,190,52,0.25);
}

/* Thank You */
.ll-thankyou {
  padding: 5rem 0;
  text-align: center;
  background: #FBFAF3;
  min-height: 60vh;
  display: flex;
  align-items: center;
}
.ll-thankyou__card {
  max-width: 600px;
  margin: 0 auto;
  background: #fff;
  padding: 3rem;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
}
.ll-thankyou__icon {
  width: 64px; height: 64px;
  background: linear-gradient(135deg, #503AA8, #9B51E0);
  color: #fff;
  font-size: 32px;
  line-height: 64px;
  border-radius: 50%;
  margin: 0 auto 1.5rem;
}
.ll-thankyou__card h1 {
  font-family: var(--font-heading);
  font-size: 2rem;
  color: #0A1A2F;
  margin-bottom: 1rem;
}
.ll-thankyou__card p {
  color: #6B7280;
  font-size: 1.05rem;
  line-height: 1.6;
}
.ll-thankyou__card .highlight {
  background: rgba(253,190,52,0.1);
  border-left: 4px solid #FDBE34;
  padding: 1rem 1.25rem;
  border-radius: 0 8px 8px 0;
  margin: 1.5rem 0;
  text-align: left;
  color: #0A1A2F;
  font-size: 0.95rem;
  line-height: 1.6;
}

/* Responsive */
@media (max-width: 768px) {
  .ll-hero__grid {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .ll-hero__flyer {
    max-width: 400px;
    margin: 0 auto;
    order: -1;
  }
  .ll-hero__title { font-size: 1.8rem; }
  .ll-hero__details { justify-content: center; }
  .ll-hero__details li { justify-content: center; }
  .ll-walkaway__grid {
    grid-template-columns: 1fr 1fr;
  }
  .ll-signup__grid {
    grid-template-columns: 1fr;
  }
  .ll-form .form-row {
    grid-template-columns: 1fr;
  }
}
@media (max-width: 480px) {
  .ll-walkaway__grid {
    grid-template-columns: 1fr;
  }
}
</style>

<?php if ($success): ?>

<!-- ═══════ THANK YOU STATE ═══════ -->
<section class="ll-thankyou">
  <div class="container">
    <div class="ll-thankyou__card">
      <div class="ll-thankyou__icon">&#10003;</div>
      <h1>You're in!</h1>
      <p>Check your inbox, we just sent a confirmation with a calendar invite attached. If you don't see it in a few minutes, check spam.</p>
      <div class="highlight">
        <strong>Come prepared:</strong> Think about 2-3 repetitive tasks that eat up too much of your week. We'll be doing a hands-on exercise, and you might win a free consultation + custom action plan ($500 value).
      </div>
      <p>See you April 8th at Noon.<br><strong>Logan</strong></p>
    </div>
  </div>
</section>

<?php else: ?>

<!-- ═══════ HERO ═══════ -->
<section class="ll-hero">
  <div class="container">
    <div class="ll-hero__grid">
      <div class="ll-hero__content">
        <span class="ll-hero__badge">Free Event &middot; Lunch Provided</span>
        <h1 class="ll-hero__title">Too Many Hats, <span>Not Enough Hours</span></h1>
        <ul class="ll-hero__details">
          <li><span class="ll-icon">&#128197;</span> Wednesday, April 8th</li>
          <li><span class="ll-icon">&#128336;</span> Noon &ndash; 1:00 PM</li>
          <li><span class="ll-icon">&#128205;</span> WorkIT &middot; 901 S. Main St, Stillwater</li>
          <li><span class="ll-icon">&#127838;</span> Lunch by Bao House</li>
        </ul>
        <a href="#signup" class="ll-hero__scroll-cta">Reserve Your Spot &#8595;</a>
      </div>
      <div class="ll-hero__flyer">
        <?php if ($flyer = $page->image('flyer.png')): ?>
          <img src="<?= $flyer->url() ?>" alt="WorkIT Lunch & Learn, Too Many Hats, Not Enough Hours: Winning with Agentic AI, Speaker: Logan Shimmer" loading="lazy">
        <?php endif ?>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ WHAT YOU'LL WALK AWAY WITH ═══════ -->
<section class="ll-walkaway">
  <div class="container">
    <h2>What You'll Walk Away With</h2>
    <div class="ll-walkaway__grid">
      <div class="ll-walkaway__card">
        <span class="card-num">1</span>
        <p>A framework for deciding what to automate first</p>
      </div>
      <div class="ll-walkaway__card">
        <span class="card-num">2</span>
        <p>The real math on savings from automation</p>
      </div>
      <div class="ll-walkaway__card">
        <span class="card-num">3</span>
        <p>Three things you can do this week (no tech needed)</p>
      </div>
      <div class="ll-walkaway__card">
        <span class="card-num">4</span>
        <p>A free AI Starter Checklist (everyone gets one)</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ SIGNUP FORM + EVENT DETAILS ═══════ -->
<section class="ll-signup" id="signup">
  <div class="container">
    <div class="ll-signup__grid">
      <div class="ll-signup__form-card">
        <h2>Reserve Your Spot</h2>
        <p class="form-sub">Space is limited. Get there early, come with your challenges and questions.</p>

        <?php if ($error): ?>
          <div class="form-error"><?= htmlspecialchars($error) ?></div>
        <?php endif ?>

        <form class="ll-form" method="POST" action="<?= $page->url() ?>#signup">
          <!-- Honeypot, hidden from humans, bots fill it -->
          <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
            <label for="website_url">Website</label>
            <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off" value="">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="name">Name *</label>
              <input type="text" name="name" id="name" placeholder="Jane Smith" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label for="email">Work Email *</label>
              <input type="email" name="email" id="email" placeholder="jane@company.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="company">Company / Business</label>
              <input type="text" name="company" id="company" placeholder="Acme Co" value="<?= htmlspecialchars($_POST['company'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label for="job_title">Job Title</label>
              <input type="text" name="job_title" id="job_title" placeholder="Owner, Manager, etc." value="<?= htmlspecialchars($_POST['job_title'] ?? '') ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="challenge">What repetitive task eats up the most of your week? <span style="color:#6B7280; font-weight:400;">(optional)</span></label>
            <textarea name="challenge" id="challenge" placeholder="e.g. Manually entering invoices, chasing down emails, updating spreadsheets..."><?= htmlspecialchars($_POST['challenge'] ?? '') ?></textarea>
          </div>

          <button type="submit" class="ll-submit">Reserve My Spot</button>
          <p class="form-note">You'll get a confirmation email with a calendar invite. No spam, ever.</p>
        </form>
      </div>

      <div class="ll-signup__info">
        <h3>Event Details</h3>

        <div class="ll-info-card">
          <div class="info-label">When</div>
          <p>Wednesday, April 8th, 2026<br>Noon &ndash; 1:00 PM (Central)</p>
        </div>

        <div class="ll-info-card">
          <div class="info-label">Where</div>
          <p>WorkIT Coworking Center<br>901 S. Main St, Stillwater, OK<br><a href="https://maps.google.com/?q=901+S+Main+St+Stillwater+OK" target="_blank" rel="noopener">Get Directions</a></p>
        </div>

        <div class="ll-info-card">
          <div class="info-label">Lunch</div>
          <p>Provided by <strong>Bao House</strong></p>
        </div>

        <div class="ll-info-card">
          <div class="info-label">Parking</div>
          <p>Street parking available. Arrive a few minutes early to grab a spot.</p>
        </div>

        <div class="ll-info-card">
          <div class="info-label">What to Bring</div>
          <p>Your biggest challenges and questions. We'll be doing a hands-on exercise during the talk.</p>
        </div>

        <div class="ll-info-card">
          <div class="info-label">Questions?</div>
          <p><a href="mailto:logan@shimmerlabs.co">logan@shimmerlabs.co</a></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ ABOUT THE PRESENTER ═══════ -->
<section class="ll-presenter">
  <div class="container">
    <div class="ll-presenter__inner">
      <h2>About <span>Logan Shimmer</span></h2>
      <p>Logan is the founder of Shimmer Labs, a boutique AI and automation consultancy based right here in Stillwater. He builds AI agents, custom software, and automation systems for small businesses, the kind of tools that handle your busywork so you can get back to the thing you actually started your business to do.</p>
      <p>He's built agent systems for companies like Supabase, taught AI security workshops at OSU, and runs his own team of AI agents that handle everything from data processing to outreach. He's not here to sell you hype, he's here to show you what actually works.</p>
      <div class="presenter-cred">
        <span class="cred-tag">Shimmer Labs Founder</span>
        <span class="cred-tag">OSU AI Instructor</span>
        <span class="cred-tag">Shopify Partner</span>
        <span class="cred-tag">WorkIT Member</span>
      </div>
    </div>
  </div>
</section>

<?php endif ?>

<script>
(function() {
  if (typeof gtag !== 'function') return;

  <?php if ($success): ?>
  // Track successful registration
  gtag('event', 'lunch_learn_registered', {
    event_category: 'lunch_learn',
    event_label: 'april_2026'
  });
  <?php else: ?>
  // Track form interactions
  var form = document.querySelector('.ll-form');
  if (!form) return;

  var started = false;
  form.addEventListener('focusin', function() {
    if (started) return;
    started = true;
    gtag('event', 'lunch_learn_form_start', {
      event_category: 'lunch_learn',
      event_label: 'april_2026'
    });
  });

  form.addEventListener('submit', function() {
    gtag('event', 'lunch_learn_form_submit', {
      event_category: 'lunch_learn',
      event_label: 'april_2026'
    });
  });
  <?php endif ?>
})();
</script>

<?php snippet('footer') ?>

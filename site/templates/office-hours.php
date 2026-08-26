<?php snippet('header') ?>

<style>
/* ═══════ Office Hours Page ═══════ */
.oh-hero {
  background: #0A1A2F;
  padding: 5rem 0 0;
  position: relative;
  overflow: hidden;
}
.oh-hero .container {
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: end;
}
.oh-hero__content { padding-bottom: 5rem; }
.oh-hero__badge {
  display: inline-block;
  background: rgba(253,190,52,0.15);
  color: #FDBE34;
  font-size: 0.85rem;
  font-weight: 600;
  padding: 0.35rem 1rem;
  border-radius: 100px;
  border: 1px solid rgba(253,190,52,0.3);
  margin-bottom: 1.5rem;
  font-family: var(--font-body);
  letter-spacing: 0.02em;
}
.oh-hero__title {
  font-family: var(--font-heading);
  font-size: 2.75rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.15;
  margin-bottom: 1.25rem;
}
.oh-hero__title span { color: #FDBE34; }
.oh-hero__subtitle {
  color: rgba(255,255,255,0.7);
  font-size: 1.1rem;
  line-height: 1.6;
  margin: 0;
}

/* Photo treatment — constrained window with gradient blend */
.oh-hero__visual {
  position: relative;
}
.oh-hero__photo-wrap {
  position: relative;
  border-radius: 12px 12px 0 0;
  overflow: hidden;
  max-height: 340px;
}
.oh-hero__photo-wrap img {
  width: 100%;
  height: 340px;
  object-fit: cover;
  object-position: center;
  display: block;
}
.oh-hero__photo-wrap::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 50%;
  background: linear-gradient(to top, #0A1A2F, transparent);
  pointer-events: none;
}

/* ═══════ Details + Whiteboard — single warm zone ═══════ */
.oh-details {
  padding: 4rem 0 0;
  background: #FBFAF3;
}
.oh-details .container { max-width: 800px; }
.oh-details__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.25rem;
  margin-bottom: 2.5rem;
}
.oh-details__card {
  background: #fff;
  border-radius: 12px;
  padding: 1.5rem;
  border-left: 4px solid #FDBE34;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.oh-details__card .card-label {
  font-weight: 600;
  font-size: 0.8rem;
  color: #503AA8;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 0.4rem;
}
.oh-details__card p {
  color: #0A1A2F;
  font-size: 0.95rem;
  line-height: 1.5;
  margin: 0;
}
.oh-details__card a {
  color: #503AA8;
  text-decoration: underline;
}

/* Calendar buttons */
.oh-cal-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}
.oh-cal-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: linear-gradient(135deg, #503AA8, #9B51E0);
  color: #fff;
  font-weight: 700;
  font-size: 1rem;
  padding: 0.85rem 1.75rem;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s;
  font-family: var(--font-heading);
}
.oh-cal-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(155,81,224,0.3);
}

/* What actually happens — whiteboard in same warm zone */
.oh-expect {
  padding: 3rem 0 4rem;
  background: #FBFAF3;
}
.oh-expect .container { max-width: 800px; }
.oh-expect h2 {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  color: #0A1A2F;
  text-align: center;
  margin-bottom: 2rem;
}
.oh-board {
  background: #2c3e50;
  border-radius: 10px;
  padding: 2.5rem;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,0.15);
  border: 4px solid #5a3e28;
}
.oh-board__items {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}
.oh-board__items li {
  font-size: 1.05rem;
  line-height: 1.5;
  color: rgba(255,255,255,0.9);
  padding-left: 1.5rem;
  position: relative;
  font-family: 'Space Grotesk', var(--font-heading), sans-serif;
}
.oh-board__items li::before {
  content: '>';
  position: absolute;
  left: 0;
  color: #FDBE34;
  font-weight: 700;
}
.oh-board__items li strong {
  color: #FDBE34;
  font-weight: 600;
}
.oh-board__footer {
  margin-top: 1.75rem;
  padding-top: 1.25rem;
  border-top: 1px dashed rgba(255,255,255,0.15);
  text-align: center;
  color: rgba(255,255,255,0.5);
  font-size: 0.9rem;
  font-style: italic;
}

/* CTA footer */
.oh-cta {
  padding: 4rem 0;
  background: #0A1A2F;
  text-align: center;
}
.oh-cta .container { max-width: 600px; }
.oh-cta__text {
  color: rgba(255,255,255,0.7);
  font-size: 1.15rem;
  line-height: 1.6;
  margin-bottom: 1.75rem;
}
.oh-cta__btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: #FDBE34;
  color: #0A1A2F;
  font-weight: 700;
  font-size: 1.05rem;
  padding: 0.9rem 2rem;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s;
  font-family: var(--font-heading);
}
.oh-cta__btn:hover {
  background: #ffe066;
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(253,190,52,0.4);
}

/* Responsive */
@media (max-width: 768px) {
  .oh-hero .container {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .oh-hero__content { padding-bottom: 2rem; }
  .oh-hero__title { font-size: 2rem; }
  .oh-hero__photo-wrap {
    border-radius: 12px;
    max-height: 200px;
  }
  .oh-hero__photo-wrap img {
    height: 200px;
  }
  .oh-details__grid { grid-template-columns: 1fr; }
  .oh-cal-buttons { flex-direction: column; align-items: center; }
  .oh-board { padding: 1.5rem; }
  .oh-board__items { grid-template-columns: 1fr; }
}
</style>

<!-- ═══════ HERO ═══════ -->
<section class="oh-hero">
  <div class="container">
    <div class="oh-hero__content">
      <span class="oh-hero__badge">Free &middot; Walk in &middot; No RSVP</span>
      <h1 class="oh-hero__title">AI <span>Office Hours</span></h1>
      <p class="oh-hero__subtitle">Bring your workflows, your questions, your half-baked ideas. I'm here to help you figure out which manual tasks are eating your time (or your sanity) and what to do about them.</p>
    </div>
    <div class="oh-hero__visual">
      <div class="oh-hero__photo-wrap">
        <img src="<?= url('assets/images/office.jpg') ?>" alt="Shimmer Labs at WorkIT Coworking, Stillwater OK" loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ═══════ DETAILS ═══════ -->
<section class="oh-details">
  <div class="container">
    <div class="oh-details__grid">
      <div class="oh-details__card">
        <div class="card-label">When</div>
        <p>Tuesdays &amp; Thursdays<br>2:00 &ndash; 4:00 PM</p>
      </div>
      <div class="oh-details__card">
        <div class="card-label">Where</div>
        <p>WorkIT Coworking Center<br>901 S. Main St, Stillwater, OK<br><a href="https://maps.google.com/?q=901+S+Main+St+Stillwater+OK" target="_blank" rel="noopener">Get Directions</a></p>
      </div>
      <div class="oh-details__card">
        <div class="card-label">Cost</div>
        <p>Free. Always will be.</p>
      </div>
      <div class="oh-details__card">
        <div class="card-label">Who Shows Up</div>
        <p>Business owners, founders, people who googled "can AI do my job" at 2 AM. All levels.</p>
      </div>
    </div>

    <div class="oh-cal-buttons">
      <a href="https://calendar.google.com/calendar/event?action=TEMPLATE&tmeid=MHQ5YWMxbHY4N2E4NHIzdjB1OG9lZ2VyNzFfMjAyNjA0MTRUMTkwMDAwWiBsb2dhbkBzaGltbWVybGFicy5jbw&tmsrc=logan%40shimmerlabs.co&scp=ALL" target="_blank" class="oh-cal-btn">Add Tuesday to Calendar &rarr;</a>
      <a href="https://calendar.google.com/calendar/event?action=TEMPLATE&tmeid=MnVnb290aGU3cjBjaDNvMzE2bXRhNjFzMXYgbG9nYW5Ac2hpbW1lcmxhYnMuY28&tmsrc=logan%40shimmerlabs.co" target="_blank" class="oh-cal-btn">Add Thursday to Calendar &rarr;</a>
    </div>
  </div>
</section>

<!-- ═══════ WHAT ACTUALLY HAPPENS ═══════ -->
<section class="oh-expect">
  <div class="container">
    <h2>What Actually Happens</h2>
    <div class="oh-board">
      <ul class="oh-board__items">
        <li><strong>Bring your questions.</strong> "Can AI do this?" "What tool should I use?" "Why is my workflow broken?" All fair game.</li>
        <li><strong>Bring your laptop.</strong> We can dig in together. Whiteboards are involved. Diagrams will be drawn.</li>
        <li><strong>Show up whenever.</strong> Drop in at 2, leave at 2:30. Come at 3:15. There's no roll call.</li>
        <li><strong>No pitch. No funnel.</strong> I'm not selling you anything. I just like solving problems and this beats eating lunch alone.</li>
      </ul>
      <div class="oh-board__footer">Basically, it's free consulting disguised as hanging out.</div>
    </div>
  </div>
</section>

<!-- ═══════ CTA ═══════ -->
<section class="oh-cta">
  <div class="container">
    <p class="oh-cta__text">Got something that needs more than two hours on a Tuesday?</p>
    <a href="/contact" class="oh-cta__btn">Let's Talk About Building It &rarr;</a>
    <p class="oh-cta__subtext">And if office hours ever helped you out, tap "Add to Preferred Sources" in the footer. Google will show you more of what we publish. Costs you nothing.</p>
  </div>
</section>

<?php snippet('footer') ?>

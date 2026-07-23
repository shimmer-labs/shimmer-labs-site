<?php snippet('header') ?>

<style>
/* ═══════ Event Video Landing Page ═══════ */
.ev-hero {
  background: linear-gradient(135deg, #0A1A2F 0%, #1a2d4a 60%, #0A1A2F 100%);
  padding: 4.5rem 0 3.5rem;
  position: relative;
  overflow: hidden;
}
.ev-hero::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; bottom: 0;
  background-image:
    linear-gradient(rgba(253,190,52,0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(253,190,52,0.04) 1px, transparent 1px);
  background-size: 60px 60px;
}
.ev-hero .container {
  position: relative;
  z-index: 1;
  max-width: 900px;
  text-align: center;
}
.ev-hero__badge {
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
.ev-hero__title {
  font-family: var(--font-heading);
  font-size: 2.75rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.1;
  margin-bottom: 1.25rem;
}
.ev-hero__title span { color: #FDBE34; }
.ev-hero__subtitle {
  color: rgba(255,255,255,0.85);
  font-size: 1.15rem;
  line-height: 1.6;
  margin: 0 auto 2rem;
  max-width: 640px;
}
.ev-hero__cta-row {
  display: flex;
  gap: 1rem;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 0.75rem;
}
.ev-hero__cta {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
  background: #FDBE34;
  color: #0A1A2F;
  font-weight: 700;
  font-size: 1.1rem;
  padding: 1rem 2.25rem;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s;
  font-family: var(--font-heading);
  box-shadow: 0 4px 20px rgba(253,190,52,0.25);
}
.ev-hero__cta:hover {
  background: #ffe066;
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(253,190,52,0.4);
}
.ev-hero__cta-secondary {
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  color: rgba(255,255,255,0.85);
  font-size: 0.95rem;
  font-weight: 500;
  text-decoration: none;
  padding: 0.75rem 0.5rem;
  border-bottom: 1px solid rgba(255,255,255,0.3);
  transition: all 0.2s;
}
.ev-hero__cta-secondary:hover {
  color: #FDBE34;
  border-color: #FDBE34;
}
.ev-hero__sub-cta {
  display: block;
  margin-top: 0.5rem;
  color: rgba(255,255,255,0.7);
  font-size: 0.9rem;
}

/* ═══════ Sample Video Section ═══════ */
.ev-sample {
  padding: 3.5rem 0;
  background: #FBFAF3;
}
.ev-sample .container { max-width: 860px; }
.ev-sample__label {
  text-align: center;
  color: #503AA8;
  font-weight: 600;
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 0.5rem;
}
.ev-sample h2 {
  font-family: var(--font-heading);
  font-size: 1.9rem;
  color: #0A1A2F;
  text-align: center;
  margin-bottom: 1.75rem;
}
.ev-sample__video {
  position: relative;
  width: 100%;
  padding-top: 56.25%;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 10px 40px rgba(0,0,0,0.15);
  background: #0A1A2F;
}
.ev-sample__video iframe {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  border: 0;
}
.ev-sample__caption {
  text-align: center;
  color: #6B7280;
  font-size: 0.9rem;
  margin-top: 1rem;
  font-style: italic;
}

/* ═══════ What You Get ═══════ */
.ev-deliverables {
  padding: 4rem 0;
  background: #fff;
}
.ev-deliverables .container { max-width: 760px; }
.ev-deliverables h2 {
  font-family: var(--font-heading);
  font-size: 2rem;
  color: #0A1A2F;
  text-align: center;
  margin-bottom: 0.5rem;
}
.ev-deliverables__sub {
  text-align: center;
  color: #6B7280;
  font-size: 1.05rem;
  margin-bottom: 2.5rem;
}
.ev-deliverables__list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.ev-deliverables__list li {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 1.15rem 1.35rem;
  background: #FBFAF3;
  border-radius: 12px;
  margin-bottom: 0.75rem;
  border-left: 4px solid #FDBE34;
}
.ev-deliverables__list .check {
  flex-shrink: 0;
  width: 28px;
  height: 28px;
  background: rgba(80,58,168,0.12);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #503AA8;
  font-weight: 700;
}
.ev-deliverables__list li > span:last-child {
  display: block;
  color: #374151;
  font-size: 0.95rem;
  line-height: 1.55;
}
.ev-deliverables__list li > span:last-child strong {
  color: #0A1A2F;
  font-weight: 600;
  display: block;
  margin-bottom: 0.2rem;
  font-size: 1.02rem;
}

/* ═══════ How It Works ═══════ */
.ev-how {
  padding: 4rem 0;
  background: #FBFAF3;
}
.ev-how .container { max-width: 960px; }
.ev-how h2 {
  font-family: var(--font-heading);
  font-size: 2rem;
  color: #0A1A2F;
  text-align: center;
  margin-bottom: 0.5rem;
}
.ev-how__sub {
  text-align: center;
  color: #6B7280;
  font-size: 1.05rem;
  margin-bottom: 2.5rem;
}
.ev-how__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}
.ev-how__card {
  background: #fff;
  border-radius: 14px;
  padding: 2rem 1.75rem;
  border: 1px solid rgba(80,58,168,0.08);
  position: relative;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.ev-how__num {
  position: absolute;
  top: -14px;
  left: 1.75rem;
  background: #FDBE34;
  color: #0A1A2F;
  font-weight: 700;
  font-family: var(--font-heading);
  font-size: 0.9rem;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.ev-how__card h3 {
  font-family: var(--font-heading);
  font-size: 1.2rem;
  color: #0A1A2F;
  margin: 0.75rem 0 0.5rem;
}
.ev-how__card p {
  color: #374151;
  font-size: 0.95rem;
  line-height: 1.55;
  margin: 0;
}

/* ═══════ Meet Karin / Trust ═══════ */
.ev-meet {
  padding: 4rem 0;
  background: #fff;
}
.ev-meet .container { max-width: 760px; }
.ev-meet__grid {
  display: grid;
  grid-template-columns: 220px 1fr;
  gap: 2.5rem;
  align-items: center;
}
.ev-meet__avatar {
  width: 220px;
  height: 220px;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: 0 8px 32px rgba(80,58,168,0.2);
  border: 4px solid #FBFAF3;
}
.ev-meet__avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.ev-meet__label {
  color: #503AA8;
  font-weight: 600;
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 0.5rem;
}
.ev-meet__content h2 {
  font-family: var(--font-heading);
  font-size: 1.9rem;
  color: #0A1A2F;
  margin-bottom: 0.75rem;
}
.ev-meet__content h2 span { color: #503AA8; }
.ev-meet__content p {
  color: #374151;
  font-size: 1rem;
  line-height: 1.65;
  margin-bottom: 0.75rem;
}

/* ═══════ Pricing Anchor ═══════ */
.ev-pricing {
  padding: 4rem 0;
  background: #FBFAF3;
}
.ev-pricing .container { max-width: 720px; text-align: center; }
.ev-pricing h2 {
  font-family: var(--font-heading);
  font-size: 2rem;
  color: #0A1A2F;
  margin-bottom: 1rem;
}
.ev-pricing__compare {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin: 2rem 0 1.5rem;
}
.ev-pricing__card {
  background: #fff;
  border-radius: 12px;
  padding: 1.75rem 1.25rem;
  border: 1px solid rgba(0,0,0,0.06);
}
.ev-pricing__card--them {
  opacity: 0.7;
  border-style: dashed;
}
.ev-pricing__card--us {
  border: 2px solid #FDBE34;
  box-shadow: 0 4px 16px rgba(253,190,52,0.15);
}
.ev-pricing__who {
  font-size: 0.85rem;
  color: #6B7280;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 0.75rem;
  font-weight: 600;
}
.ev-pricing__card--us .ev-pricing__who { color: #503AA8; }
.ev-pricing__amount {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  font-weight: 700;
  color: #0A1A2F;
  line-height: 1.1;
  margin-bottom: 0.35rem;
}
.ev-pricing__note {
  color: #6B7280;
  font-size: 0.85rem;
}
.ev-pricing__footnote {
  color: #6B7280;
  font-size: 0.9rem;
  font-style: italic;
  max-width: 540px;
  margin: 0 auto;
}

/* ═══════ Closing CTA ═══════ */
.ev-cta {
  padding: 5rem 0 6rem;
  background: linear-gradient(135deg, #0A1A2F 0%, #1a2d4a 100%);
  text-align: center;
  position: relative;
  overflow: hidden;
}
.ev-cta::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; bottom: 0;
  background-image:
    linear-gradient(rgba(253,190,52,0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(253,190,52,0.04) 1px, transparent 1px);
  background-size: 60px 60px;
}
.ev-cta .container { position: relative; z-index: 1; max-width: 720px; }
.ev-cta h2 {
  font-family: var(--font-heading);
  font-size: 2.25rem;
  color: #fff;
  margin-bottom: 1rem;
  line-height: 1.2;
}
.ev-cta h2 span { color: #FDBE34; }
.ev-cta p {
  color: rgba(255,255,255,0.85);
  font-size: 1.1rem;
  line-height: 1.6;
  margin-bottom: 2rem;
}
.ev-cta__btn {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
  background: #FDBE34;
  color: #0A1A2F;
  font-weight: 700;
  font-size: 1.15rem;
  padding: 1.05rem 2.5rem;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s;
  font-family: var(--font-heading);
  box-shadow: 0 4px 20px rgba(253,190,52,0.25);
}
.ev-cta__btn:hover {
  background: #ffe066;
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(253,190,52,0.4);
}
.ev-cta__note {
  display: block;
  margin-top: 1.25rem;
  color: rgba(255,255,255,0.7);
  font-size: 0.9rem;
}
.ev-cta__note a {
  color: #FDBE34;
  text-decoration: underline;
}

/* ═══════ Sticky Mobile CTA ═══════ */
.ev-sticky-cta {
  display: none;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #0A1A2F;
  padding: 0.85rem 1rem calc(0.85rem + env(safe-area-inset-bottom));
  box-shadow: 0 -4px 20px rgba(0,0,0,0.2);
  z-index: 100;
  border-top: 1px solid rgba(253,190,52,0.2);
}
.ev-sticky-cta a {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  background: #FDBE34;
  color: #0A1A2F;
  font-weight: 700;
  font-size: 1rem;
  padding: 0.9rem 1.25rem;
  border-radius: 8px;
  text-decoration: none;
  font-family: var(--font-heading);
}

/* ═══════ Responsive ═══════ */
@media (max-width: 768px) {
  .ev-hero { padding: 3rem 0 2.5rem; }
  .ev-hero__title { font-size: 1.9rem; max-width: 320px; margin-left: auto; margin-right: auto; }
  .ev-hero__subtitle { font-size: 1rem; }
  .ev-hero__cta-row { flex-direction: column; gap: 0.75rem; }
  .ev-sample h2,
  .ev-deliverables h2,
  .ev-how h2,
  .ev-meet__content h2,
  .ev-pricing h2 { font-size: 1.5rem; }
  .ev-how__grid { grid-template-columns: 1fr; }
  .ev-meet__grid {
    grid-template-columns: 1fr;
    text-align: center;
    gap: 1.5rem;
  }
  .ev-meet__avatar {
    width: 140px;
    height: 140px;
    margin: 0 auto;
  }
  .ev-pricing__compare { grid-template-columns: 1fr; }
  .ev-cta { padding: 4rem 0 7.5rem; }
  .ev-cta h2 { font-size: 1.6rem; }
  .ev-sticky-cta { display: block; }
}
</style>

<!-- ═══════ HERO ═══════ -->
<section class="ev-hero">
  <div class="container">
    <span class="ev-hero__badge">🎬 Event Videos &middot; Done Right, Done Fast</span>
    <h1 class="ev-hero__title">Turn your raw footage into a recap <span>worth sharing.</span></h1>
    <p class="ev-hero__subtitle">You bring the clips. We write the script, record the voiceover, and cut the final edit. Delivered in days, not weeks. Priced for humans, not agencies.</p>
    <div class="ev-hero__cta-row">
      <a href="https://calendly.com/logan-shimmerlabs/event-video" target="_blank" rel="noopener" class="ev-hero__cta">Book a 15-Min Intro Call &rarr;</a>
      <a href="#sample" class="ev-hero__cta-secondary">See our work &darr;</a>
    </div>
    <span class="ev-hero__sub-cta">Free. No commitment. Just a conversation about what you've got.</span>
  </div>
</section>

<!-- ═══════ SAMPLE VIDEO ═══════ -->
<section class="ev-sample" id="sample">
  <div class="container">
    <div class="ev-sample__label">See Our Work</div>
    <h2>This is what we mean by "worth sharing."</h2>
    <div class="ev-sample__video">
      <iframe src="https://www.youtube.com/embed/31U-SAh8NLM?rel=0" title="Sample event recap video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <p class="ev-sample__caption">A recent event recap. Raw footage in, polished video out.</p>
  </div>
</section>

<!-- ═══════ WHAT YOU GET ═══════ -->
<section class="ev-deliverables">
  <div class="container">
    <h2>What You Actually Get</h2>
    <p class="ev-deliverables__sub">No bloat. No mystery line items. Just a video people will actually watch.</p>
    <ul class="ev-deliverables__list">
      <li>
        <span class="check">&#10003;</span>
        <span><strong>A story, not a slideshow</strong>We write a script that gives your event a narrative arc, so the video has a point beyond "here are some clips."</span>
      </li>
      <li>
        <span class="check">&#10003;</span>
        <span><strong>Clean voiceover you didn't record</strong>Professional narration. You don't have to narrate it. Your speakers don't either.</span>
      </li>
      <li>
        <span class="check">&#10003;</span>
        <span><strong>A polished cut, ready to share</strong>Color, pacing, music, captions. Drops straight into LinkedIn, YouTube, your sponsor deck, your next pitch.</span>
      </li>
      <li>
        <span class="check">&#10003;</span>
        <span><strong>In your hands in a week</strong>Most projects deliver in 5 to 7 business days. Faster when you need it.</span>
      </li>
      <li>
        <span class="check">&#10003;</span>
        <span><strong>A flat price, up front</strong>You know the number before we start. No scope-creep games, no mystery invoices.</span>
      </li>
    </ul>
  </div>
</section>

<!-- ═══════ HOW IT WORKS ═══════ -->
<section class="ev-how">
  <div class="container">
    <h2>How It Works</h2>
    <p class="ev-how__sub">Three steps. No production crew. No studio time.</p>
    <div class="ev-how__grid">
      <div class="ev-how__card">
        <span class="ev-how__num">1</span>
        <h3>You send the clips</h3>
        <p>Drop your footage in a shared folder. Phone video, DSLR, whatever you have. No format policing.</p>
      </div>
      <div class="ev-how__card">
        <span class="ev-how__num">2</span>
        <h3>We write &amp; voice it</h3>
        <p>We build the script, record the voiceover, and map out the story. You review before we cut.</p>
      </div>
      <div class="ev-how__card">
        <span class="ev-how__num">3</span>
        <h3>We deliver the final cut</h3>
        <p>Polished edit with music, transitions, and captions. One round of tweaks included.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ MEET LOGAN ═══════ -->
<section class="ev-meet">
  <div class="container">
    <div class="ev-meet__grid">
      <div class="ev-meet__avatar">
        <img src="<?= url('assets/images/logan-headshot-sq.jpg') ?>" alt="Logan Shimmer">
      </div>
      <div class="ev-meet__content">
        <div class="ev-meet__label">Who You're Talking To</div>
        <h2>Your intro call is with <span>Logan.</span></h2>
        <p>When you book, you're talking to the founder of Shimmer Labs. No account rep, no funnel, no "let me get you with a specialist." Just a direct conversation about what you shot and what you want to do with it.</p>
        <p>You'll walk away with a clear sense of scope, timeline, and cost. If it's a fit, we move. If not, no hard feelings.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ PRICING ANCHOR ═══════ -->
<section class="ev-pricing">
  <div class="container">
    <h2>Priced for humans, not agencies.</h2>
    <p class="ev-pricing__footnote" style="font-style: normal; font-size: 1.05rem; color: #374151; margin-bottom: 1.5rem;">Traditional production houses run five figures and six-week timelines. We don't. Cost scales with length, number of clips, and how fast you need it. We quote flat before we start. No surprises, no scope-creep games.</p>
    <p class="ev-pricing__footnote">Short recap? Long-form highlight reel? Multiple cuts for different channels? Tell us on the call and we'll give you the number.</p>
  </div>
</section>

<!-- ═══════ CLOSING CTA ═══════ -->
<section class="ev-cta">
  <div class="container">
    <h2>Ready to turn that footage into <span>something worth sharing?</span></h2>
    <p>Grab a 15-minute intro call. We'll talk through your footage, your timeline, and what it'll cost. No pitch deck, no pressure.</p>
    <a href="https://calendly.com/logan-shimmerlabs/event-video" target="_blank" rel="noopener" class="ev-cta__btn">Book Your Intro Call &rarr;</a>
    <span class="ev-cta__note">Prefer email? <a href="mailto:logan@shimmerlabs.co">logan@shimmerlabs.co</a></span>
  </div>
</section>

<!-- ═══════ STICKY MOBILE CTA ═══════ -->
<div class="ev-sticky-cta">
  <a href="https://calendly.com/logan-shimmerlabs/event-video" target="_blank" rel="noopener">Book 15-Min Intro Call &rarr;</a>
</div>

<?php snippet('footer') ?>

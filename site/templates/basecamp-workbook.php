<?php snippet('header', ['noindex' => true]) ?>

<style>
/* ═══════ Basecamp Workbook holding page ═══════ */
.bw-hero { background: #0A1A2F; padding: 4.5rem 0; }
.bw-hero .container {
  display: grid;
  grid-template-columns: 1.05fr 1fr;
  gap: 3.5rem;
  align-items: center;
}
.bw-badge {
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
.bw-title {
  font-family: var(--font-heading);
  font-size: 3rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.1;
  margin: 0 0 1.25rem;
}
.bw-title span { color: #FDBE34; }
.bw-lede {
  color: rgba(255,255,255,0.82);
  font-size: 1.2rem;
  line-height: 1.6;
  margin: 0 0 1rem;
  max-width: 34rem;
}
.bw-lede strong { color: #fff; }
.bw-photo { margin: 0; }
.bw-photo img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: cover;
  object-position: 30% 70%;
  border-radius: 14px;
  display: block;
  box-shadow: 0 24px 60px rgba(0,0,0,0.45);
}
.bw-photo figcaption {
  color: rgba(255,255,255,0.55);
  font-size: 0.85rem;
  margin-top: 0.75rem;
  text-align: right;
}
.bw-flyer { background: #FBFAF3; padding: 4.5rem 0 5rem; }
.bw-flyer .container {
  display: grid;
  grid-template-columns: 1fr 1.1fr;
  gap: 3.5rem;
  align-items: center;
  max-width: 1000px;
}
.bw-flyer h2 {
  font-family: var(--font-heading);
  font-size: 2rem;
  line-height: 1.2;
  color: #0A1A2F;
  margin: 0 0 1rem;
}
.bw-flyer p { color: #33404f; font-size: 1.1rem; line-height: 1.65; margin: 0 0 1rem; }
.bw-facts { list-style: none; padding: 0; margin: 1.5rem 0 0; }
.bw-facts li {
  padding: 0.85rem 0;
  border-top: 1px solid rgba(10,26,47,0.12);
  color: #0A1A2F;
  font-size: 1.05rem;
  line-height: 1.45;
}
.bw-facts b {
  display: block;
  font-size: 0.78rem;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: #8a6a0f;
  margin-bottom: 0.15rem;
}
.bw-flyer__img img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 10px;
  box-shadow: 0 18px 50px rgba(10,26,47,0.22);
}
@media (max-width: 820px) {
  .bw-hero { padding: 3rem 0; }
  .bw-hero .container, .bw-flyer .container { grid-template-columns: 1fr; gap: 2rem; }
  .bw-title { font-size: 2.2rem; }
  .bw-lede { font-size: 1.08rem; }
  .bw-flyer { padding: 3rem 0 3.5rem; }
  .bw-flyer h2 { font-size: 1.6rem; }
}
</style>

<main class="main-content">
  <section class="bw-hero">
    <div class="container">
      <div>
        <span class="bw-badge">Basecamp Workbook &middot; Automate with Confidence</span>
        <h1 class="bw-title">Well, aren't you an <span>eager little beaver.</span></h1>
        <p class="bw-lede">We're just putting some finishing touches on the workbook.</p>
        <p class="bw-lede"><strong>It'll be right here, ready for you to use at Basecamp.</strong></p>
      </div>
      <figure class="bw-photo">
        <img src="<?= url('assets/images/basecamp/eager-beaver.jpg') ?>" alt="A beaver in a pond, working on a pile of sticks" width="1280" height="851">
        <figcaption>Us, right now, with the workbook.</figcaption>
      </figure>
    </div>
  </section>

  <section class="bw-flyer">
    <div class="container">
      <div>
        <h2>Yep, you're in the right place.</h2>
        <p>This is the workbook page for Business in the Age of AI. Come back to this same link at Basecamp.</p>
        <ul class="bw-facts">
          <li><b>When</b>Monday, November 16, 2026</li>
          <li><b>Where</b>Meridian Technology Center, 1312 S Sangre Rd, Stillwater</li>
          <li><b>The workbook is for</b>Automate with Confidence, 1:00 PM</li>
        </ul>
      </div>
      <div class="bw-flyer__img">
        <img src="<?= url('assets/images/basecamp/basecamp-flyer.jpg') ?>" alt="Flyer for Business in the Age of AI, Monday, November 16, 2026 at Meridian Technology Center in Stillwater" width="1082" height="1400" loading="lazy">
      </div>
    </div>
  </section>
</main>

<?php snippet('footer') ?>

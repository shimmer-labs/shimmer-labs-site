<?php
// The AI Starter Kit sales page. Unlisted (noindex, not in the nav) until the
// course is published in Skool. To launch: drop the noindex flag below and
// point $kitUrl at the course link.
$kitUrl = 'https://www.skool.com/main-street-ai-2900/about';
snippet('header', ['noindex' => true]);
?>

<style>
/* ═══════ AI Starter Kit ═══════ */
.sk-hero { background: #0A1A2F; padding: 3.5rem 0 3.25rem; }
.sk-hero .container { max-width: 1080px; }
.sk-grid { display: grid; grid-template-columns: 1fr 1.05fr; gap: 2.75rem; align-items: center; }
.sk-badge {
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
.sk-title {
  font-family: var(--font-heading);
  font-size: 2.7rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.1;
  margin: 0 0 1rem;
}
.sk-title span { color: #FDBE34; }
.sk-lede { color: rgba(255,255,255,0.82); font-size: 1.15rem; line-height: 1.6; margin: 0 0 1.5rem; }
.sk-actions { display: flex; flex-wrap: wrap; gap: 0.9rem; align-items: center; }
.sk-btn {
  display: inline-block;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 1.05rem;
  padding: 0.85rem 1.4rem;
  border-radius: 10px;
  text-decoration: none;
  border: 2px solid #FDBE34;
  background: #FDBE34;
  color: #0A1A2F;
}
.sk-btn:hover { filter: brightness(1.08); }
.sk-price { color: #fff; font-family: var(--font-heading); font-weight: 700; font-size: 1.15rem; }
.sk-price small { display: block; color: rgba(255,255,255,0.65); font-family: var(--font-body); font-weight: 400; font-size: 0.9rem; }
.sk-note { color: rgba(255,255,255,0.65); font-size: 0.95rem; line-height: 1.55; margin: 1.1rem 0 0; }
.sk-video {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.14);
  box-shadow: 0 18px 50px rgba(0,0,0,0.4);
  background: #05101f;
  aspect-ratio: 1012 / 720;
  object-fit: cover;
}
.sk-caption { color: rgba(255,255,255,0.6); font-size: 0.9rem; margin: 0.7rem 0 0; }

.sk-section { padding: 3.25rem 0; background: #FBFAF3; }
.sk-section--white { background: #fff; }
.sk-section .container { max-width: 1080px; }
.sk-h2 { font-family: var(--font-heading); font-size: 1.9rem; font-weight: 700; color: #0A1A2F; margin: 0 0 0.6rem; line-height: 1.2; }
.sk-sub { color: #3b4a5c; font-size: 1.08rem; line-height: 1.6; margin: 0 0 1.75rem; max-width: 44rem; }
.sk-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.1rem; }
.sk-card { background: #fff; border: 1px solid rgba(10,26,47,0.12); border-radius: 12px; padding: 1.4rem 1.3rem; }
.sk-section--white .sk-card { background: #FBFAF3; }
.sk-card h3 { font-family: var(--font-heading); font-size: 1.2rem; color: #0A1A2F; margin: 0 0 0.5rem; }
.sk-card p { color: #3b4a5c; font-size: 1rem; line-height: 1.55; margin: 0; }
.sk-num { display: inline-block; background: #FDBE34; color: #0A1A2F; font-family: var(--font-heading); font-weight: 700; border-radius: 6px; padding: 0.1rem 0.55rem; margin-bottom: 0.7rem; font-size: 0.95rem; }
.sk-list { list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: 1fr 1fr; gap: 0.7rem 2rem; }
.sk-list li { color: #24364a; font-size: 1.05rem; line-height: 1.5; padding-left: 1.5rem; position: relative; }
.sk-list li::before { content: ""; position: absolute; left: 0; top: 0.55em; width: 0.6rem; height: 0.6rem; border-radius: 2px; background: #FDBE34; }
.sk-close { background: #0A1A2F; padding: 3rem 0; text-align: center; }
.sk-close h2 { font-family: var(--font-heading); color: #fff; font-size: 1.9rem; margin: 0 0 0.6rem; }
.sk-close p { color: rgba(255,255,255,0.78); font-size: 1.08rem; line-height: 1.6; margin: 0 auto 1.4rem; max-width: 38rem; }
@media (max-width: 900px) {
  .sk-grid { grid-template-columns: 1fr; gap: 1.75rem; }
  .sk-cards { grid-template-columns: 1fr; }
  .sk-list { grid-template-columns: 1fr; }
  .sk-title { font-size: 2.05rem; }
  .sk-hero { padding: 2.25rem 0; }
  .sk-section { padding: 2.25rem 0; }
}
</style>

<main class="main-content">
  <section class="sk-hero">
    <div class="container">
      <div class="sk-grid">
        <div>
          <span class="sk-badge">Video course and prompt kit</span>
          <h1 class="sk-title">The AI Starter Kit: <span>three helpers, one afternoon.</span></h1>
          <p class="sk-lede">Set up Claude to draft your email replies, plan your week, and write your posts. In your voice, with your rules. I walk you through every step on video and hand you every prompt I use.</p>
          <div class="sk-actions">
            <a class="sk-btn" href="<?= $kitUrl ?>" target="_blank" rel="noopener">Get the kit in Main Street AI</a>
            <span class="sk-price">$299 <small>one time, no monthly fee</small></span>
          </div>
          <p class="sk-note">The course lives inside Main Street AI, my free community on Skool. Join the group, then open the Classroom.</p>
        </div>
        <div>
          <video class="sk-video" autoplay muted loop playsinline preload="metadata" poster="<?= url('assets/starter-kit/content-guru-poster.jpg') ?>">
            <source src="<?= url('assets/starter-kit/content-guru-loop.mp4') ?>" type="video/mp4">
          </video>
          <p class="sk-caption">From Lesson 4. Two photos and one sentence in, a post for each channel out. Sped up.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="sk-section">
    <div class="container">
      <h2 class="sk-h2">What you build</h2>
      <p class="sk-sub">Three jobs that eat most of the week. Each one is a Claude Project with a few plain files that tell it how you work.</p>
      <div class="sk-cards">
        <div class="sk-card">
          <span class="sk-num">1</span>
          <h3>The Email Drafter</h3>
          <p>You pick which kinds of email get a draft. It writes them the way you write and leaves them in Gmail for you to read and send. It never sends anything.</p>
        </div>
        <div class="sk-card">
          <span class="sk-num">2</span>
          <h3>Your Week at a Glance</h3>
          <p>It reads your calendar, flags conflicts, finds open hours for the work that matters, and preps you for your meetings. It suggests. You decide.</p>
        </div>
        <div class="sk-card">
          <span class="sk-num">3</span>
          <h3>Content Guru</h3>
          <p>Hand it a photo and a sentence. It writes a version for each place you post, following each one's rules. Your photos and your words. No AI images.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="sk-section sk-section--white">
    <div class="container">
      <h2 class="sk-h2">What's in the kit</h2>
      <p class="sk-sub">Everything I use, nothing held back.</p>
      <ul class="sk-list">
        <li>Six short videos. You watch me build each one, mistakes and all.</li>
        <li>Every prompt, ready to copy and paste.</li>
        <li>A Brand Kit you build first, so you only explain your business once.</li>
        <li>My own files as examples, so you can see what a finished one looks like.</li>
        <li>One folder with all of it to download and keep.</li>
        <li>A place to ask questions: the Main Street AI community.</li>
      </ul>
    </div>
  </section>

  <section class="sk-section">
    <div class="container">
      <h2 class="sk-h2">What you need</h2>
      <p class="sk-sub">Claude, plus Gmail and Google Calendar. No other software to buy. If you can copy and paste, you can do this.</p>
      <div class="sk-cards">
        <div class="sk-card">
          <h3>You stay in charge</h3>
          <p>Drafts wait for you. Calendar changes wait for your go. Posts get published by you.</p>
        </div>
        <div class="sk-card">
          <h3>Start small</h3>
          <p>You turn on one kind of email first. You add more once the drafts have earned it.</p>
        </div>
        <div class="sk-card">
          <h3>It's yours to keep</h3>
          <p>Everything is plain files. Change them any time, or take them to another tool later.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="sk-close">
    <div class="container">
      <h2>Ready to get your week back?</h2>
      <p>Join Main Street AI for free, open the Classroom, and start with the first video.</p>
      <a class="sk-btn" href="<?= $kitUrl ?>" target="_blank" rel="noopener">Get the kit in Main Street AI</a>
    </div>
  </section>
</main>

<?php snippet('footer') ?>

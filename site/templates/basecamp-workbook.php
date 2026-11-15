<?php snippet('header', ['noindex' => true]) ?>

<style>
/* ═══════ Basecamp Workbook ═══════ */
.bw-hero { background: #0A1A2F; padding: 3.25rem 0 3rem; }
.bw-hero .container { max-width: 900px; }
.bw-badge {
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
.bw-title {
  font-family: var(--font-heading);
  font-size: 2.6rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.12;
  margin: 0 0 1rem;
}
.bw-title span { color: #FDBE34; }
.bw-lede {
  color: rgba(255,255,255,0.82);
  font-size: 1.15rem;
  line-height: 1.6;
  margin: 0 0 1.5rem;
  max-width: 40rem;
}
.bw-actions { display: flex; flex-wrap: wrap; gap: 0.75rem; }
.bw-btn {
  display: inline-block;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 1rem;
  padding: 0.8rem 1.3rem;
  border-radius: 10px;
  text-decoration: none;
  border: 2px solid #FDBE34;
}
.bw-btn--solid { background: #FDBE34; color: #0A1A2F; }
.bw-btn--line { background: transparent; color: #FDBE34; }
.bw-btn:hover { filter: brightness(1.08); }
.bw-join {
  color: rgba(255,255,255,0.7);
  font-size: 0.98rem;
  line-height: 1.55;
  margin: 1.25rem 0 0;
  max-width: 40rem;
}
.bw-book { background: #FBFAF3; padding: 2rem 0 4rem; }
.bw-book .container { max-width: 900px; }
.bw-frame {
  width: 100%;
  min-height: 80vh;
  border: 1px solid rgba(10,26,47,0.14);
  border-radius: 12px;
  background: #fff;
  display: block;
  box-shadow: 0 14px 40px rgba(10,26,47,0.10);
}
@media (max-width: 820px) {
  .bw-hero { padding: 2.25rem 0 2rem; }
  .bw-title { font-size: 2rem; }
  .bw-lede { font-size: 1.05rem; }
  .bw-book { padding: 1rem 0 3rem; }
  .bw-book .container { padding-left: 0.5rem; padding-right: 0.5rem; }
}
</style>

<main class="main-content">
  <section class="bw-hero">
    <div class="container">
      <span class="bw-badge">Business in the Age of AI Basecamp &middot; November 16, 2026</span>
      <h1 class="bw-title">Automate with Confidence: <span>the workbook.</span></h1>
      <p class="bw-lede">Everything from the session, right here. Every prompt has a Copy button, so paste it into your chatbot and replace anything in [brackets].</p>
      <div class="bw-actions">
        <a class="bw-btn bw-btn--solid" href="https://www.skool.com/main-street-ai-2900/about" target="_blank" rel="noopener">Join Main Street AI (free)</a>
        <a class="bw-btn bw-btn--line" href="<?= url('assets/basecamp/Basecamp-Workbook.pdf') ?>" target="_blank" rel="noopener">Download the PDF</a>
      </div>
      <p class="bw-join">Main Street AI is where the slides and the plain-text prompts live, and where the full <a href="<?= url('ai-starter-kit') ?>" style="color:#FDBE34">AI Starter Kit</a> course lives, with the calendar and content builds we didn't have time for.</p>
    </div>
  </section>

  <section class="bw-book">
    <div class="container">
      <iframe class="bw-frame" id="bw-frame" title="Automate with Confidence workbook" src="<?= url('basecamp-workbook/full') ?>"></iframe>
    </div>
  </section>
</main>

<script>
(function () {
  var f = document.getElementById('bw-frame');
  function fit() {
    try {
      var d = f.contentDocument;
      // Measure the content (body), not the document: the document is never
      // shorter than the frame, so sizing from it made the frame grow forever.
      if (d && d.body) {
        var h = d.body.offsetHeight + 4;
        if (Math.abs(f.offsetHeight - h) > 1) { f.style.height = h + 'px'; }
      }
    } catch (e) {}
  }
  f.addEventListener('load', function () {
    fit();
    setTimeout(fit, 400);
    try { f.contentWindow.addEventListener('resize', fit); } catch (e) {}
  });
  window.addEventListener('resize', fit);
})();
</script>

<?php snippet('footer') ?>

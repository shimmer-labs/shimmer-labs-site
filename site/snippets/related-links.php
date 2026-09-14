<?php
/**
 * Related links: gives every content page real in-body links to its
 * neighbors so nothing depends on the nav and footer alone.
 * Works for: automate-first pages, notes, trade pages, city pages, case studies.
 */
$tpl = $page->intendedTemplate()->name();
$parentSlug = $page->parent() ? $page->parent()->slug() : '';
$groups = []; // [label => Pages|array of [url,title]]

$autoIndex = page('automate-first');
$notesIndex = page('notes');
$tradeTwin = [ // automate-first slug => trade page slug, and back
  'landscapers' => 'landscapers', 'plumbers' => 'plumbers', 'hvac-companies' => 'plumbers', 'roofers' => 'roofers',
];

if ($parentSlug === 'automate-first') {
  $siblings = $autoIndex->children()->listed()->not($page);
  $groups['Other trades'] = $siblings;
  $extra = [];
  if (isset($tradeTwin[$page->slug()]) && ($t = page($tradeTwin[$page->slug()]))) $extra[] = $t;
  foreach (['notes/ai-consultant-cost-per-employee', 'notes/hours-ai-saves-per-employee', 'notes/why-ai-pilots-fail'] as $n) if ($p = page($n)) $extra[] = $p;
  $groups['Keep reading'] = $extra;
} elseif ($parentSlug === 'notes') {
  $groups['More notes'] = $notesIndex->children()->listed()->not($page)->sortBy('date', 'desc')->limit(4);
  $groups['What should your trade automate first?'] = $autoIndex ? $autoIndex->children()->listed()->limit(6) : [];
} elseif ($tpl === 'trade') {
  $twin = array_search($page->slug(), $tradeTwin, true);
  $extra = [];
  if ($twin && ($p = page('automate-first/' . $twin))) $extra[] = $p;
  if ($page->slug() === 'plumbers' && ($p = page('automate-first/hvac-companies'))) $extra[] = $p;
  foreach (['landscapers', 'plumbers', 'roofers', 'oklahoma-city-ai-consultant', 'tulsa-ai-consultant', 'stillwater-ai-consultant'] as $s) if ($s !== $page->slug() && ($p = page($s))) $extra[] = $p;
  $groups['Related'] = $extra;
  $groups['What should your trade automate first?'] = $autoIndex ? $autoIndex->children()->listed()->limit(8) : [];
} elseif ($tpl === 'case-study') {
  $groups['More case studies'] = $page->siblings(false)->listed()->limit(4);
  $groups['What should your trade automate first?'] = $autoIndex ? $autoIndex->children()->listed()->limit(6) : [];
}
$groups = array_filter($groups, fn($g) => is_array($g) ? count($g) > 0 : $g->count() > 0);
if (!$groups) return;
?>
<section class="related">
  <div class="container">
    <?php foreach ($groups as $label => $items): ?>
      <div class="related__group">
        <h2 class="related__title"><?= html($label) ?></h2>
        <ul class="related__list">
          <?php foreach ($items as $p): ?>
            <li><a href="<?= $p->url() ?>"><?= html($p->title()) ?></a></li>
          <?php endforeach ?>
          <?php if ($label === 'Other trades' || $label === 'What should your trade automate first?'): ?>
            <li><a href="<?= $autoIndex->url() ?>" class="related__all">All trades &rarr;</a></li>
          <?php endif ?>
        </ul>
      </div>
    <?php endforeach ?>
  </div>
</section>

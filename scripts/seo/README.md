# SEO / AEO reporting scripts

Run from the repo root: `node scripts/seo/<script>`. Google scripts use the service account key at `~/.config/shimmer-seo/service-account.json`. Bing uses `~/.config/shimmer-seo/bing-api-key`. Both files stay out of the repo.

| Script | What it does |
|---|---|
| `gsc-week.mjs A1 A2 B1 B2` | Search Console clicks/impressions/queries/pages, week A vs week B (dates YYYY-MM-DD) |
| `ga4-week.mjs A1 A2 B1 B2` | GA4 sessions by source, landing pages, AI referrers flagged (chatgpt.com, perplexity.ai, copilot, gemini) |
| `bing-week.mjs [/path ...]` | Bing Webmaster: last 7 days vs prior, top queries, crawl, submission quota, optional per-URL info |
| `inspect.mjs /path ...` | Search Console URL inspection with the API's own `inspectionResultLink` (never hand-build these links) |
| `inspect-all.mjs` | Every sitemap URL: verdict, canonical mismatch, rich-result issues, crawl age. Run monthly or after a big push |
| `deep.mjs` | 30-day queries, pages, and GA4 sources for the "where is traffic coming from" question |
| `indexnow.mjs [/path ...]` | Ping IndexNow (Bing, DuckDuckGo, Yandex) with changed URLs; no args = whole sitemap. Run after every content push |

The same Google scripts exist in `~/techie-grandkid/scripts/seo/` (URL-prefix property, GA4 554863060). Bing Webmaster Tools is NOT yet set up for techiegrandkid.com.

## The weekly report, in order

1. `gsc-week.mjs` and `ga4-week.mjs` for both sites (this repo, then `~/techie-grandkid`).
2. `bing-week.mjs` here. Bing's numbers are small; the point is whether the missing pages are coming in and whether ChatGPT-driven brand queries show up.
3. `inspect.mjs` on anything changed that week, plus anything the last report flagged. Hand back at most ~10 inspection links, priority order; Google's Request Indexing quota is ~10/day.
4. If anything was pushed that week: confirm `indexnow.mjs` ran. Bing URL Submission in the dashboard is a separate 100/day quota (Home > URL Submission card > Submit URLs, one per line) for pages IndexNow hasn't picked up.
5. Every few weeks, the AI citation spot check by hand in Chrome (see below).
6. Every few weeks, Google Business Profile: reviews count, Services list, posts, hours consistency. Path is in memory `gsc_gbp_operations.md`.

## AI citation spot check (manual)

ChatGPT works logged out with `https://chatgpt.com/?q=<query>&hints=search`. Wait ~10 s, screenshot, scroll to the end, click Sources. Run at least: "who is a good AI consultant for a small business in Stillwater Oklahoma", "best AI consultant for a small business in Oklahoma City", one trade question ("I run a small plumbing company in Oklahoma, what should I automate first"), one cost question. Google AI Mode: `google.com/search?q=<query>&udm=50` in Logan's Chrome (personalized to Stillwater, say so in the report). Perplexity needs sign-in in Chrome. Record which sources each answer cites, not just whether we appear. Baseline Sep 28 2026 is in `references/sep-2026-handoffs/offsite-audit-chatgpt.md`.

## Things that bit us (do not relearn)

- Never trust `$page->modified()` on this site: DigitalOcean zeroes mtimes (1980). Dates come from `Date:` and `Updated:` fields. Bump `Updated:` whenever a content file changes, or the sitemap and Article schema lie.
- Bing bot SERPs are junk on desktop (dictionary entries, Terraria). Use SerpApi `device: mobile` and the `url:` operator for per-URL index checks, or read Bing Webmaster Tools directly.
- SerpApi Google positions are unreliable versus real Google; screenshots and Search Console are ground truth.
- Rolling deploys can serve new HTML with old CSS under the new hash. Poll twice before calling a deploy verified. The local PHP server links CSS from the live domain, so test CSS edits by injecting the rule in Playwright, not by reloading.
- Google pages time out `browser_batch`; use one Chrome call at a time. Bing pages are fine either way.
- Bing Places syncs weekly FROM Google Business Profile. Edit GBP, never Bing Places.
- Any page with fewer than two in-body inbound links ends up "Discovered, not indexed". Fix links before requesting indexing.
- Meta descriptions are trimmed to a whole sentence under 158 chars in header.php, but write an explicit `Meta_description:` on every new page anyway.
- Report AI-citation results with the cited sources listed, and say which engine and whether it was signed in.

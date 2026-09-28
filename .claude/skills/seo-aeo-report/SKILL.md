---
name: seo-aeo-report
description: Weekly SEO/AEO report for shimmerlabs.co and techiegrandkid.com. Pulls Search Console, GA4, Bing Webmaster, URL inspection, IndexNow status, and the manual AI-citation check, then writes the report Logan expects.
---

# Weekly SEO / AEO report

Follow `scripts/seo/README.md` in this repo for the script list, run order, and the lessons list. Read it before running anything; it is the source of truth and this skill only adds the reporting rules.

## Steps

1. Compute the date windows: week A is the last full 7 days, week B the 7 before. Run `node scripts/seo/gsc-week.mjs A1 A2 B1 B2` and `node scripts/seo/ga4-week.mjs A1 A2 B1 B2` here, then the same in `~/techie-grandkid`.
2. Run `node scripts/seo/bing-week.mjs`. If the key file is missing, say so and skip; do not narrate how to get the key from memory, open Bing Webmaster Tools in Chrome and look.
3. Run `node scripts/seo/inspect.mjs` on every page changed since the last report and every page the last report flagged. Include the API's `inspectionResultLink` for each, never a hand-built URL. Cap the request-indexing list at 10, priority first, and say which to skip if quota is short.
4. If content was pushed since the last report, confirm `node scripts/seo/indexnow.mjs` ran for those paths; run it if not.
5. Every third report, or after a positioning change: the manual AI-citation check in Chrome (procedure in the README) and a GBP check (reviews, Services list, posts, hours).
6. Check `ROADMAP.md` "Open" block for SEO items and note status changes.

## Reporting rules

- Lead with the one number that changed the most and what caused it. Then a short table: site, clicks, impressions, top non-brand query, AI-referrer sessions. Brand versus non-brand split every time.
- Bing and ChatGPT go in the same report as Google, not a footnote. ChatGPT search runs on Bing's index, so Bing coverage is an AEO metric.
- Rank findings by traffic effect. Say plainly when something is hygiene rather than SEO.
- Never use em dashes. Never name a client or scanned business without permission. No dashboard click paths from memory; open the dashboard or give the principle.
- End with the indexing links and the two or three things only Logan can do (reviews, GBP, link asks).

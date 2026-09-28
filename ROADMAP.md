# Shimmer Labs Site Roadmap

## Open, as of Sep 28 2026 (everything below this block is history)

**Logan only**
- [ ] (moved to Open) GBP reviews: 2 today. Ask the 7 case-study clients. Local pack leaders have 6 to 79.
- [x] GBP description (checked in Chrome Sep 28: already the operations-partner copy, category Business management consultant).
- [ ] GBP Services list is empty under the primary category (only "IT consulting" under Computer consultant). Add: Operations Assessment ($1,500), AI Concierge (from $1,000/mo), Sidecar (from $1,000), Free AI Office Hours ($0). Path: search "Shimmer Labs" signed in as logan@shimmerlabs.co > Edit services. Also add the company LinkedIn, Facebook, Instagram under social profiles. Or tell Claude to do it in Chrome.
- [ ] Validate the two Event schema fixes under Search Console > Enhancements > Events after /office-hours is recrawled.
- [ ] (moved to Open) Decide Concierge cadence (site: two sessions a month; Kimberly call: weekly at $2k) before the next close.
- [ ] GHL nurture on the `concierge-intake` tag: build the 4-email sequence (references/sep-2026-handoffs/ghl-concierge-nurture.md) and paste the Assessment line; times are 2 to 3 PM.
- [ ] Google Ads copy still says the flat $1,000/mo Concierge; replacement in references/sep-2026-handoffs/google-ads-copy.md.
- [ ] Landscaper permission to be named and quoted (upgrades the anonymous case study and gives OKC/Tulsa pages a "businesses we've sat with" section).
- [ ] Sweep Desktop sell sheets and decks still carrying $5k-era pricing.
- [ ] Postmortem asks: the roofer/HVAC church prospect and Heritage Petroleum.
- [ ] Watch /services/assessment in Search Console; two requests in, still "discovered, not indexed." If it's still out on Oct 5, we look at why.

**Claude, on your go**
- [x] Sep 28 technical audit fixes shipped (commit 7306d72): cache + security headers, 1200x630 social card, og:title = title, 45 real meta descriptions, Updated fields on every sitemap page, Article image everywhere, Event schema endDate/validFrom, trailing-slash 301s, image dimensions, anna-moore.jpg 805KB to 70KB, service-worker cleanup removed.
- [ ] Next audit pass, lower value: webp/srcset for the hero and testimonial photos; PageSpeed run needs an API key; automate-first titles are 91 to 129 chars (Google truncates around 60, the question stays visible so leaving them).
- [ ] Local notes, one a week: calendar in references/sep-2026-handoffs/local-notes-calendar.md. First: "Do I need a CRM, or just a spreadsheet and an AI?" (the garage door installer), target Oct 5.
- [ ] Scan promo: posts drafted in references/sep-2026-handoffs/scan-promo-posts.md; 27 scans in six months, half ours.
- [ ] Velvet Fudge outreach (dead Shopify store): references/sep-2026-handoffs/velvet-fudge-outreach.md.
- [ ] No-website audience line on the office-hours page (salons, trainers on Acuity/Square/Linktree are who the describe-your-business box is for).
- [ ] Weekly SEO/AEO report, both sites: `node scripts/seo/gsc-week.mjs` and `ga4-week.mjs` here and in ~/techie-grandkid. Next: Oct 5.
- [ ] (moved to Open) AB Newswire test ($80 to $100, three releases) only if Logan wants the press-release angle.

**Parked (Feb 2026 ideas, not wrong, not now)**
- www.shimmerlabs.co does not resolve (nameservers are DigitalOcean). No ranking effect; only matters if someone types or links the www form. If ever wanted, add www as a redirect domain on the App Platform app with the DO dashboard open in Chrome, not from memory.
- Buy automatepaperwork.com and point it at /plumbers; trade microsites once a trade page shows traction; Loom-style sales video behind a QR; vendor-show calendar; Google Voice number; Shopify Partners; Alignable; Contra; TikTok live coding; CurbCheck page; EventSnag Android mention; case-study storytelling format; more testimonials beyond Danny and Kristen.

---


**Created:** February 12, 2026
**Context:** Pivoting from automation consulting → custom software for small/niche businesses

---

## High Priority — Messaging Mismatch

The site still says "automation consulting" everywhere but we're selling custom app development now.

- [x] **Homepage hero rewrite** (Sep 21) — swap "Automate Your Business, Reclaim Your Time" for custom software messaging
- [x] **Homepage services section** (Sep 21) — currently lists "API Wrappers, Business Automation, n8n Workflows, SaaS Integrations" — update to reflect actual offerings
- [x] **Homepage CTA** (Sep 21) — "Ready to Automate Your Business?" → custom software angle
- [x] **Footer tagline** (Sep 21) — "Let's automate your business" → new positioning
- [x] **Contact page intro** (Sep 21) — "What tool or workflow are you stuck on?" → broader intake question

## Medium Priority — Missing Content

- [x] **About page** (Sep 21) — basically empty, needs Logan's story + pivot narrative
- [x] **Lunch & Learn recording landing page** (/lunch-learn now 301s to /office-hours) — update lunch-learn page to offer access to the Apr 8 WorkIT recording instead of sign-up
- [ ] (moved to Open) **Add CurbCheck** project page (even as "In Development")
- [x] **Review packages/pricing** (Sep 21 ladder) — current: API Integrations ($3.5-12k), Idea→Web App ($25-85k), iOS Apps ($35-75k)
- [ ] (moved to Open) **More testimonials** — only have Danny Mathews and Kristen Hadley

## Low Priority — Nice to Have

- [ ] (moved to Open) **Add Velvet Fudge** as a project/case study once work begins
- [ ] (moved to Open) **Shopify-specific angle** — highlight FlowMint as proof of Shopify app dev
- [ ] (moved to Open) **EventSnag Android** mention once TikTok vibe coding streams start
- [ ] (moved to Open) **Case studies format** — more storytelling around project results vs just portfolio cards

---

## Current Site Inventory (Feb 2026)

### Projects on Site (8 total)
| # | Project | Badge | Featured |
|---|---------|-------|----------|
| 1 | FlowMint | Live | Yes |
| 2 | TreeBidPro | Live | Yes |
| 3 | Paidly | Live | Yes |
| 4 | EventSnag | Live | Yes |
| 5 | Taddy API n8n Nodes | Live | Yes |
| 6 | Amazon Price Tracker | Live | No |
| 7 | Apify Gov Monitor | Live | No |
| 8 | OffTheAppsOK | Live | No |

### NOT on Site Yet
- CurbCheck (iOS, active development)
- Velvet Fudge (potential Shopify client)
- EventSnag Android (planned)

### Lead Gen / Distribution (set up Feb 12, 2026)
- [x] Google Business Profile — created
- [x] Google Ads Smart Campaign — created with updated copy
- [ ] (moved to Open) Google Voice number — for business calls
- [ ] (moved to Open) Shopify Partners signup
- [ ] (moved to Open) TikTok live coding streams
- [ ] (moved to Open) Alignable profile
- [ ] (moved to Open) Contra portfolio

---

## August 25, 2026 — Post Alex Evers session (pricing reset + trade pages)

Shipped this session: $1k/$250 pricing floor with half-up-front terms, landscaper case study, /landscapers /plumbers /roofers trade pages, /notes articles, FAQPage schema everywhere, canonical tags, sitemap + llms.txt updates.

### Follow-ups
- [ ] (moved to Open) **Buy automatepaperwork.com** (~$12/yr, confirmed available at check time; stopthepaperwork.com, automatemyinvoices.com, okpaperwork.com also looked free). Point it at shimmerlabs.co/plumbers or a picker page via Cloudflare redirect. Skip oklahomaai.com / stillwaterai.com (parked at Afternic, aftermarket priced).
- [ ] (moved to Open) **Landscaper permission** — ask him to be named + quoted, then upgrade the anonymous case study (photos, name, testimonial)
- [ ] (moved to Open) **Postmortem asks** — the roofer/HVAC church prospect and Heritage Petroleum ("help me understand where it lost you")
- [ ] (moved to Open) **Home & garden show / state fair vendor calendar** within ~100 miles; go early morning, reverse-prospect (Alex's play)
- [ ] (moved to Open) **Short Loom-style sales video** behind a QR code for in-person events
- [ ] (moved to Open) **Sweep Desktop sell sheets / decks** still carrying $5k-era pricing
- [ ] (moved to Open) **Watch trade page traffic** in GA4; whichever trade gets traction graduates to a standalone microsite on its own domain (Alex's stillwaterkids.com play)

---

## September 10, 2026 — Team-size pricing, scanner reframe, 17 industry templates

Shipped Sep 7-9: legacy 404 redirects, Review schema removed, AI Concierge priced by team size (Solo $750 / Crew $1,000 / Shop $1,500 / Company $2,250 / 51+ custom, founding = one tier down), three math/why notes, homepage retitled around AI consulting, GBP post + category + description, website scanner reframed around the three-rung ladder (do it yourself / build it together / have it built and run) with a rendered-scrape fallback, describe-your-business path, prefilled intake, and all 17 industry templates tuned against real Stillwater/OKC/Tulsa sites (new: property management, auto services, cleaning, creative services, oil & gas operators).

### Next up, in order of payoff
- [x] **16 industry pages for SEO/AEO** (shipped Sep 10, /automate-first) — "What should a plumber in Oklahoma automate first?" generated from the tuned templates: three tasks, the copy-paste prompt, ladder, FAQPage schema, link to /scan. One per template, same voice as the Sep 7 notes.
- [ ] (moved to Open) **Get scans flowing** — posts drafted in references/sep-2026-handoffs/scan-promo-posts.md. 27 scans in six months, half ours. GBP post + personal FB/LinkedIn post ("put your website in, see what to take off your plate"), human-sourced per the Sep 1 rule. Watch GA4 `scan_started` vs `scan_completed` vs `scan_failed` and `scan_next_step`.
- [x] **Search Console housekeeping** (404s handled Sep 10; Validate Fix is a UI click, low value now) — click Validate Fix on the Not found (404) and Review snippets reports; export the 404 CSV (Pages report > Not found > Export) and drop it in the repo root for redirect mapping. Request-indexing quota is ~10/day.
- [ ] (moved to Open) **Old pricing off-site** — Google Ads copy still says the flat $1,000/mo concierge. Replacement copy in references/sep-2026-handoffs/google-ads-copy.md (the Ads UI would not render for the browser tool, so it is a paste job). (Brand kit doc in Desktop/Presentations still carries $2,000/$500 Sidecar anchor; site says from $1,000 + $250/mo. llms.txt updated Sep 10.)
- [ ] (moved to Open) **GHL nurture on the `concierge-intake` tag** — 4-email sequence drafted in references/sep-2026-handoffs/ghl-concierge-nurture.md; build in the GHL UI (PIT has no workflows scope). Also delete the dead CALENDLY_URL var on Vercel.
- [x] **Two more scanner templates** (shipped Sep 10: coworking, event_venues; 19 total, pages at /automate-first/coworking-spaces and /event-venues)
- [ ] (moved to Open) **Velvet Fudge** — velvetfudgevinyl.com is a dead "store unavailable" Shopify page. Outreach message in references/sep-2026-handoffs/velvet-fudge-outreach.md.
- [ ] (moved to Open) **No-website audience** — many salons/massage/trainers only have Acuity/Square/Linktree. That's who the "describe your business" box is for; say so in the office-hours pitch.
- [x] **Vlad on Leadership episode push** (posted Sep 10) (Sep 10) — comment on Vlad's share, own LinkedIn post, FB personal + page + Main Street AI group, quote card. Copy in `references/podcast-vlad/`.
- [x] **Re-index the industry pages** (all 18 indexed by Sep 15) — 10 links handed over Sep 10 (index + 9 trades); the other 7 next day. Pull fresh links via the API, never hand-built.
- [x] **Vary the page intros** (done Sep 10, ten of eighteen hand-rewritten)

- [x] **Internal linking pass** (Sep 14) — related-links blocks, trade chips, breadcrumbs. Re-run the link graph after adding sections; nothing important should sit at 0 in-body inbound links (still at 0 by design: /comparison, /work, /sbu, /event-video, /business-at-lunch).
- [x] **Re-request** cleaning-companies (never crawled), coworking-spaces (crawled, not indexed), paidly (still on the Aug 30 copy), event-video, eventsnag, office-hours.

### Carry-forward from Aug 25 (still open)
- [ ] (moved to Open) Buy automatepaperwork.com; landscaper permission for the named case study; postmortem asks (roofer/HVAC church prospect, Heritage Petroleum); vendor-show calendar; Loom-style sales video behind a QR; sweep Desktop sell sheets with $5k-era pricing; watch trade-page traffic monthly (search is a 90-day bet, not a two-week one).

### Sep 15 2026: header / structure audit (see references/sep-2026-handoffs/seo-aeo-structure-audit.md)
Shipped: direct answers under H1s (18 trade pages, home, concierge, sidecar, office hours, 3 notes), descriptive H2s, city in city-page H1s, intake noindex + out of sitemap, scanner below the pitch on service pages, main landmarks, office-hours FAQ + Event schema, home thesis stats updated to 2025/2026 figures.
Still open (need a decision or facts):
- [x] Duplicate trade pages: kept both, retitled /plumbers, /roofers, /landscapers as Sidecar done-for-you pages with a first paragraph linking the matching /automate-first guide (Sep 15).
- [x] /work is noindex,follow and out of the sitemap; footer link kept (Sep 15).
- [x] /stillwater-ai-consultant rewritten concierge-first on the trade template with FAQ, scanner, intake CTA, and an opt-in map section (`Show_map: true`); old template deleted (Sep 15).
- [x] OKC and Tulsa each got a 'What we see in' section (route, suburbs, trades we meet there, links to the matching guides) and a metro-coverage FAQ. No client names used; add one when there is a client to name (Sep 15).
- [ ] AB Newswire test ($80 to $100, three releases in a month) if Logan wants to try the press-release angle.

### Sep 21 2026: operations-first repositioning + Operations Assessment
Shipped: new /services/assessment page (free Snapshot > paid Assessment > Concierge > Sidecar ladder), Concierge bumped to $1,000 / $1,500 / $2,250 / $3,000, home H1 + lede + 4-card ladder + engagement steps rewritten operations-first, title tag "Operations and AI Consultant", intake `start_with` field, schema/llms/menu/footer/city pages/notes updated. Deliverable templates in references/sep-2026-handoffs/operations-assessment-template.md and -print.html.
Logan's side:
- [ ] (moved to Open) GBP description: lead with "operations partner for small businesses" and add the Assessment; keep AI in the second sentence. Category "Business management consultant" already fits.
- [ ] Decide Concierge cadence: site says two sessions a month; Kimberly call said weekly at $2k. Pick one before the next close.
- [x] Resend intake auto-reply branches on start_with (Sep 21). 
- [ ] (moved to Open) GHL nurture: paste the Assessment line from references/sep-2026-handoffs/operations-positioning-handoff.md into the live email; the handoff doc's office-hours time is now 2 to 3 PM, check the live template matches.
- [x] Request re-indexing (done Sep 22 and Sep 28; /services/assessment still 'discovered, not indexed', watch it).
- [x] Recheck Sep 28: search data for the new title tag and the assessment page.

### Sep 28 2026: traffic source audit (30 days) and competitor SERPs
Findings: 792 impressions, 13 clicks, all 13 brand. AI concierge note = 378 impr / 1 click at pos 19. GBP surfaces at pos 1 for marketing/consulting queries (0 clicks). AI Mode cites us on Stillwater-geo and trade "automate first" queries only; 0 citations on OKC/Tulsa or any /notes. Schema dates were 1980 sitewide (fixed Sep 28). Full SERP + AEO reports in the session; competitor set: Opinosis (Tulsa city page, ~3,500 words, 8 FAQs, testimonials), Nexvora (daily city posts), Coffey & Consult (OKC pack #1, 17 reviews).
Priority moves (in order):
- [ ] GBP reviews: 2 today; ask the 7 case-study clients. Pack leaders have 6 to 79. Confirm primary category (SERP shows Business management consultant).
- [x] LinkedIn headline copy delivered Sep 28 (personal + company page); Logan to paste. Was: Logan's headline is the only Shimmer asset ranking for "AI consultant Tulsa/OKC"; link the three city pages from About.
- [x] Note: "How much does an AI consultant cost?" (Sep 28) answered in sentence one with the real $1,000 to $3,000 range + Assessment fee, FAQPage. Current AIO source is a content farm.
- [x] Note: "What is a fractional operations partner?" (Sep 28) (SERP is LinkedIn profiles and a job board; winnable).
- [x] City pages (Sep 28): on-page quotes, LocalBusiness + areaServed suburbs, footer links. Still open: "businesses we've sat with in [city]" needs named clients with permission. Was: on-page testimonial quotes, "businesses we've sat with in [city]", LocalBusiness schema with areaServed suburbs (NSN Management's Tulsa page is the model), footer links from every page.
- [x] Trade guides retitled Sep 28. Was: add "AI automation for [trade] companies in Oklahoma" phrasing to title/H2; track "plumbing company" variant, the exact "what should a plumber automate first" query is glitching on Google's side.
- [x] New note (Sep 28): "how do I stop retyping invoices into QuickBooks" (no matching page; AIO cites a tax coach).
- [x] Decided Sep 28: stop investing in "what is an AI concierge" for search; Google reads it as hotel chatbots.
- [ ] (moved to Open) One local-tied note per week: four-week calendar in references/sep-2026-handoffs/local-notes-calendar.md (first one Oct 5, the garage door installer).

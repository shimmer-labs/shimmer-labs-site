# Bing track: off-site SEO audit for shimmerlabs.co (Sep 28, 2026)

## Method note (read first)
Bing serves a degraded "first word only" index to non-browser traffic. Desktop SerpApi calls and direct `bing.com/search?format=rss` curls both returned junk (Terraria for "Shimmer Labs Stillwater", OpenAI for "AI consultant Stillwater Oklahoma", Khan Academy for `site:shimmerlabs.co`). The SerpApi `device: mobile` profile returned genuine SERPs (real competitors, Copilot answers, ads), so every ranking below is from mobile Bing. The `site:` operator was refused on both profiles; the `url:` operator worked on mobile and was used as a per-URL index check. Six negatives were re-tested and all six stayed negative. Mobile page 2 (`first=6`) reverted to junk, so positions 6 to 10 are not verifiable.

## 1. Bing index coverage vs sitemap (67 URLs)

| Status | Count |
|---|---|
| Confirmed in Bing (appeared in a real SERP or answered `url:` check) | 33 |
| Confirmed missing (`url:` returned no results) | 28 |
| Not retried (SerpApi rate limit) | 6 |

**Confirmed indexed (33):** `/`, `/about`, `/contact`, `/office-hours`, `/plumbers`, `/landscapers`, `/stillwater-ai-consultant`, `/oklahoma-city-ai-consultant`, `/ai-agents-guide`, `/ai-security-business`, `/ai-security-education`, `/comparison`, `/event-video`, `/business-at-lunch/`, `/riata-center/`, `/case-studies` plus all 7 case studies (eventsnag, flowmint, paidly, stillwater-landscaper, sweat-yoga-fitness, taddy-api-integrations, treebidpro), `/automate-first/accountants-and-consultants`, `/automate-first/restaurants`, `/automate-first/shops`, `/notes/why-ai-pilots-fail`, `/notes/ai-employee-schedule`, `/notes/ai-what-to-delegate`, `/notes/automate-without-new-software`, `/notes/can-ai-read-handwriting`, `/notes/cost-to-automate-invoicing`, `/notes/what-is-an-ai-concierge`.

**Confirmed missing (28):**
- `/automate-first` (the index page itself)
- `/automate-first/auto-detailers`, `/cleaning-companies`, `/contractors`, `/coworking-spaces`, `/electricians`, `/event-venues`, `/gyms-and-salons`, `/hvac-companies`, `/landscapers`, `/oil-and-gas-operators`, `/photographers-and-makers`, `/plumbers`, `/property-managers`, `/realtors`, `/roofers` (15 of 18 trade pages)
- `/notes` (the index page itself)
- `/notes/ai-consultant-cost-per-employee`, `/google-data-center-community-ai-fellowship`, `/hours-ai-saves-per-employee`, `/how-much-does-an-ai-consultant-cost`, `/spot-ai-scams`, `/stillwater-state-of-the-city-2026`, `/stop-re-explaining-to-ai`, `/stop-retyping-invoices-into-quickbooks`, `/what-is-a-fractional-operations-partner`
- `/roofers`, `/sbu`

**Not retried (6):** `/services/api-integrations`, `/services/assessment`, `/services/concierge`, `/services/custom-apps`, `/services/sidecar`, `/tulsa-ai-consultant`. (Brave's index does contain `/services/custom-apps` and `/services/sidecar`, which is weak evidence Bing has them too, but unverified.)

Pattern: Bing has the older, evergreen pages and almost none of the newer programmatic content. Both section index pages (`/automate-first`, `/notes`) are missing, which points to Bing not recrawling since those sections were built, and no sitemap being processed because there is no Webmaster Tools property.

## 2. Brand and Bing Places

**"Shimmer Labs Stillwater" (mobile Bing):** 1 shimmerlabs.co, 2 /about, 3 Logan's LinkedIn profile, 4 coworkit.net/shimmer-labs-ai-office-hours, 5 coworkit.net/business-spotlight-shimmer-labs.
**"Shimmer Labs Oklahoma":** 1 shimmerlabs.co, 2 /about, 3 /stillwater-ai-consultant, 4 /oklahoma-city-ai-consultant, 5 LinkedIn company page.
**Quoted brand queries (desktop, the only desktop responses that were sane)** also surfaced: bizapedia.com (SHIMMER LABS LLC), crunchbase.com, comparemsp.com ("Shimmer Labs (Stillwater), AI Trust Score 44/100, Balanced MSP, 5.0 across 2 reviews"), and the YouTube "Automating Main Street" video. No Facebook result appeared anywhere.
**Phone query** `"Shimmer Labs" "Stillwater" 405-880-6674`: 27 results; top 5 were shimmerlabs.co, /contact, both LinkedIn pages, Crunchbase. No directory snippet shows the phone number.

**Bing Places / Maps:** No listing for Shimmer Labs. `bing_maps` for "Shimmer Labs Stillwater OK" resolves to **WorkIT Coworking Center**, 901 S Main St, Stillwater, OK 74074, +1 405-622-3882, coworkit.net, category "Coworking space", claimed, Yelp 5.0 (1 review). "Shimmer Labs" alone returns nothing on Bing Maps. No local pack or Places card appeared in any brand SERP. The WebFetch of `bing.com/maps?q=...` only returned the page shell. Caveat: bot SERPs can suppress local packs, so absence of a card in a real browser is not 100% verified, but the Maps engine result is strong evidence there is no listing.

## 3. Non-brand rankings (mobile Bing, cc=US; top 5 verified, 6 to 10 not verifiable)

| Query | Shimmer Labs position | Top 3 domains |
|---|---|---|
| AI consultant Stillwater Oklahoma | **#2** (/stillwater-ai-consultant) and **#4** (/) | albenze.ai, shimmerlabs.co, albenze.ai |
| AI consultant Oklahoma City small business | absent (top 4 organic; ads: Thumbtack, Bark) | aisuperior.com, automatenexus.com, theerinmoore.com |
| operations consultant Oklahoma small business | absent (top 5) | nathanneil.com, clutch.co, scissortailfractional.com |
| what should a plumber automate first | absent (top 4; Copilot answer cites nevermisshq, deelo, blvkware, bestlyfegroup, systemifai) | nevermisshq.com, nevermisshq.com, blvkware.dev |
| free AI office hours Stillwater | **#1** (/office-hours) and **#2** (/stillwater-ai-consultant); Copilot answer cites /office-hours first | shimmerlabs.co, shimmerlabs.co, linkedin.com |
| fractional operations partner Oklahoma | absent (top 5) | truenorthcoo.com, scissortailfractional.com, markcmo.com |

Note that `/automate-first/plumbers` and `/notes/what-is-a-fractional-operations-partner`, the two pages built for the plumber and fractional queries, are both in the confirmed-missing list. They cannot rank until they are indexed.

## 4. IndexNow / Bing Webmaster Tools
- Homepage has **no** `<meta name="msvalidate.01">`; `/BingSiteAuth.xml` and `/indexnow.txt` both 404; no IndexNow key referenced anywhere. robots.txt explicitly allows Bingbot and lists the sitemap.
- **GSC import is still live and verified from Bing's own sources.** The help page https://www.bing.com/webmasters/help/add-and-verify-site-12184f8b is JS-rendered, but its embedded UI strings read: "Already verified on Google Search Console?", "Import your sites from GSC", "No site verification required", "Import sitemaps instantly", "We will only import the list of your verified sites to automatically add them to Bing Webmaster Tools", "We will also import sitemaps submitted on Google Search Console, but we will not be importing any site analytics related data", and it requests "View-Only permissions" on the GSC account. The Bing Webmaster blog post https://blogs.bing.com/webmaster/september-2019/Import-sites-from-Search-Console-to-Bing-Webmaster-Tools (Sept 13, 2019, updated June 2025) gives the steps: sign in to Bing Webmaster Tools, go to My Sites and click Import, sign in with the Google account that holds the verified GSC property and click Allow, select the site and click Import. Up to 100 sites per import; reports populate in about 48 hours. Since shimmerlabs.co is already verified in GSC (Aug 2026), this is a one-click path with no tag or file to add.
- IndexNow (https://www.bing.com/indexnow/getstarted): generate a key, host `{key}.txt` at the site root, POST changed URLs to api.indexnow.org.

## 5. DuckDuckGo and Brave
- **DuckDuckGo:** blocked. `html.duckduckgo.com`, `lite.duckduckgo.com`, and `duckduckgo.com/html` all returned a bot challenge ("anomaly" / duck captcha). No count available.
- **Brave:** 6 pages of 67 for `site:shimmerlabs.co`, stable across five query variants: `/`, `/about`, `/case-studies/taddy-api-integrations`, `/services/custom-apps`, `/services/sidecar`, `/stillwater-ai-consultant`.

## Three highest-value actions
1. **Import the site into Bing Webmaster Tools from GSC** (My Sites > Import > Allow > Import). This takes minutes, brings the sitemap with it, and replaces this bot-based audit with Bing's own index coverage report. Then use URL Submission on the 28 missing pages, starting with `/automate-first`, `/notes`, `/automate-first/plumbers`, and `/notes/what-is-a-fractional-operations-partner`.
2. **Add IndexNow to the Kirby publish flow** (key file at root, ping on page save). The missing list is almost entirely the newer notes and trade pages, which means Bing is not recrawling on its own; IndexNow fixes that permanently and also feeds DuckDuckGo and other IndexNow partners.
3. **Create a Bing Places for Business listing** for Shimmer Labs at 901 S Main St Suite 86, (405) 880-6674, with an operations/AI consulting category (Bing Places can import from Google Business Profile). Right now the address resolves only to WorkIT, so brand searches with local intent have no Shimmer Labs card to show.

Not verified and worth a real-browser check: presence or absence of a Bing local pack on brand queries, positions 6 to 10 on the non-brand queries, and the six not-retried `/services/*` and `/tulsa-ai-consultant` URLs.
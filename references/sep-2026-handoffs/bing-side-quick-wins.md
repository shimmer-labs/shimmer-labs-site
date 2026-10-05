Research done. Here is the report.

## Bing / Microsoft side: cheap one-time items, ranked by expected value for shimmerlabs.co

**1. Fix robots meta so Copilot can quote you (free, 5 min). Highest value.**
Bing rewrote its Webmaster Guidelines on Feb 27, 2026 and added a GEO section. Per the guidelines: NOARCHIVE removes content from Copilot answers and grounding entirely; NOCACHE limits Copilot to URL, title, and snippet; NOSNIPPET / data-nosnippet "may limit citation quality"; max-snippet:-1 means no limit. Bing explicitly says avoid NOCACHE on content you want cited. The reverse is the only "opt-in": make sure none of these are set and `max-snippet` is not capped. Also note the guidelines say "GEO doesn't guarantee citations."
Sources: https://www.bing.com/webmasters/help/webmaster-guidelines-30fba23a and https://www.bing.com/webmasters/help/robots-meta-tags-and-attributes-that-bing-supports-5198d240 (both JS-rendered; I verified the content via SEJ's writeup: https://www.searchenginejournal.com/bing-adds-geo-to-official-guidelines-expands-ai-abuse-definitions/568442/).

**2. Bing Webmaster Tools AI Performance report (free, already available, 0 min).**
Public preview since Feb 2026: total citations, cited pages, and "grounding queries" (the phrases Copilot used to retrieve your pages). Microsoft's own advice in that post: clear headings, tables, FAQ sections, keep content current, use IndexNow "to enable faster content discovery across search and AI systems." This is your measurement layer; check it monthly.
https://blogs.bing.com/webmaster/February-2026/Introducing-AI-Performance-in-Bing-Webmaster-Tools-Public-Preview

**3. Schema (JSON-LD) on service and article pages (free, one-time).**
Fabrice Canel confirmed at SMX Munich (March 2025) that schema helps Microsoft's LLMs understand content. Krishna Madhavan's Oct 8, 2025 post repeats it ("Schema is a type of code that helps search engines and AI systems understand your content") and states Copilot and Microsoft Start are "powered by Bing's search index." You already have schema; just make sure it matches visible text.
https://about.ads.microsoft.com/en/blog/post/october-2025/optimizing-your-content-for-inclusion-in-ai-search-answers

**4. IndexNow: already done, and it does reach Copilot (free).**
Bing's July 2025 sitemaps post: IndexNow and sitemaps support "Bing's crawling and indexing, both for traditional search and AI-powered experiences like Copilot." IndexNow.org confirms one ping is "shared across all IndexNow-enabled search engines": Bing, Yandex, Naver, Seznam, Yep, Amazon. DuckDuckGo and ChatGPT search ride the Bing index, so nothing extra to do there. Yandex and Naver Webmaster accounts exist but are irrelevant for an Oklahoma consultancy; skip.
https://blogs.bing.com/webmaster/2025/7/Keeping-Content-Discoverable-with-Sitemaps-in-AI-Powered-Search/ and https://www.indexnow.org/faq

**5. Bing Places extras (free, 20 min). Moderate value, mostly for local Copilot queries.**
The Oct 2025 relaunch post promises "deeper integrations with Bing Maps and Copilot" and a Recommendation Tool that nags you to add photos, website, hours, social links. Announcements (Bing's version of Google Posts) exist. I could not verify Q&A, services, or booking links from Microsoft docs; the help portal at bing.com/forbusiness/help is JS-only and returned nothing. Also no Microsoft doc states Copilot reads specific Bing Places attributes; that claim is third-party only. Flagged unverified.
https://blogs.bing.com/search/2025/10/Introducing-the-New-Bing-Places-for-Business-Built-for-Business-Owners,-Powered-by-Research/

**6. Microsoft Clarity (free, 10 min). Analytics only, but now has an AI Visibility tab.**
No Microsoft doc says Clarity feeds ranking or indexing. Bing's own 2020 framing: "use Bing Webmaster Tools for SEO & SEM optimization, Clarity will help you optimize site usability and debugging." The Aug 2024 Bing post on A/B testing treats it purely as behavior analytics. What changed: the Clarity FAQ (updated Sept 2026) now has an "AI Visibility" section showing "which queries trigger AI citations and which pages are referenced," plus Bot Activity if you connect Cloudflare. Worth installing for that reporting alone, not for ranking.
https://learn.microsoft.com/en-us/clarity/faq and https://blogs.bing.com/webmaster/August-2024/A-B-Test-for-Better-Search-Engine-Performance-with-IndexNow-and-Microsoft-Clarity

**7. Microsoft Advertising $500-for-$250 (costs $250). Paid only.**
Terms: new US customers, spend $250, get $500 credit, 90-day expiry on the credit, offer ends June 30, 2027. No Microsoft doc claims any organic or Copilot effect. Only worth it if you'd run Bing ads anyway.
https://ads.microsoft.com/ (terms) and https://learn.microsoft.com/en-us/answers/questions/2288842/when-do-you-get-the-500-in-free-ads

**8. Content Submission API. Skip.**
Open to all verified sites since Sept 2021, but Bing now points people to IndexNow instead. Redundant for you.
https://blogs.bing.com/webmaster/september-2021/Bing-Content-Submission-API-open-for-all-webmasters

**9. MSN / Microsoft Start Partner Hub. Not available.**
Invite-only, and Microsoft Q&A (Sept 18, 2025) says onboarding is "temporarily paused" with no timeline.
https://learn.microsoft.com/en-us/answers/questions/5538022/request-to-join-microsoft-start-partner-hub

**10. Connected Pages. Gone.**
Not in the 2020 rebuilt Webmaster Tools; the 2020 migration posts don't mention it and no current help page exists. Third-party sources say it was dropped. Flagged: no explicit Microsoft retirement notice found.

## Could not verify
- llms.txt: no Microsoft statement for or against anywhere on bing.com, blogs.bing.com, or learn.microsoft.com. Treat as harmless, zero evidence of effect.
- Separate AI crawler user agent: the crawler help page is JS-only. Third-party sources say Copilot uses the bingbot index with no distinct Copilot bot.
- Bing Places Q&A / services / booking fields and Copilot attribute reads.

Honest read at ~5 impressions a week: items 1 through 4 are the only ones that move anything, and they mostly already exist. The rest is bookkeeping.
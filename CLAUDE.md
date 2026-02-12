# Shimmer Labs Website - Claude Development Guide

**Last Updated:** October 19, 2025
**Project:** Shimmer Labs portfolio and business website
**Stack:** Kirby CMS 5.0 (PHP flat-file), deployed on Digital Ocean
**Repository:** https://github.com/shimmer-labs/shimmer-labs-site

---

## Project Overview

This is the main website for Shimmer Labs, a boutique automation consultancy based in Stillwater, OK. The site showcases:
- Portfolio projects (automation workflows, iOS apps, web projects)
- OffTheAppsOK - Local event discovery Instagram account
- EventSnag - iOS app for turning event screenshots into calendar entries
- Client services and contact forms

---

## Tech Stack

**CMS:** Kirby 5.0 (flat-file PHP CMS)
- Content stored in `/content/` as `.txt` files with YAML frontmatter
- Templates in `/site/templates/`
- Blueprints (admin UI schemas) in `/site/blueprints/`
- Snippets (reusable components) in `/site/snippets/`

**Frontend:**
- Vanilla JavaScript (`/assets/js/main.js`)
- CSS (`/assets/css/main.css`) - Custom CSS, no frameworks
- No build process - straight HTML/CSS/JS

**Hosting:** Digital Ocean
- Auto-deploys from `main` branch
- App Platform (PHP runtime)

**Forms:** Formspree
- EventSnag waitlist: `xnngrlnp` → logan@shimmerlabs.co
- Contact Us: `xdkwjykz` → logan@shimmerlabs.co

**Analytics:**
- Google Analytics 4: `G-KPVHKHKJJY`
- Plausible Analytics (also enabled)

---

## ⚠️ Lessons Learned

### Custom API Routes (October 21, 2025)
**Don't try to build custom API endpoints in this Kirby+Vercel setup.**

**What happened:**
- Attempted to replace Formspree with a custom waitlist API (Node.js serverless function + Firestore)
- Spent hours troubleshooting routing conflicts between Kirby's PHP routing and Vercel's Node.js functions
- Tried multiple approaches: Node.js API, PHP routes in Kirby config, explicit Vercel routing rules
- None worked - Kirby's routing system consistently returned 404s for custom API endpoints
- Had to revert everything back to Formspree

**Why it failed:**
- Kirby CMS + Vercel's mixed PHP/Node.js runtime = routing conflicts
- Kirby catches all routes via `index.php` before Node.js functions can execute
- Even Kirby's custom routes (following official docs) didn't work properly for POST JSON endpoints
- The framework is opinionated about routing and doesn't play well with external API functions

**Lessons:**
1. **Formspree works perfectly** for simple form → email workflows. Don't overcomplicate.
2. **Know when to stop** - After 2-3 failed approaches, revert rather than continuing to break things
3. **Don't fix what isn't broken** - The existing solution was stable and working
4. **If you need custom backend logic**, use a separate Vercel project or different serverless platform entirely
5. **Mixed runtime environments are complex** - PHP + Node.js on the same Vercel project creates routing hell

**The right approach for future custom APIs:**
- Deploy as a completely separate Vercel project (e.g., `api.shimmerlabs.co`)
- Or use Cloudflare Workers, AWS Lambda, or other dedicated serverless platform
- Keep the Kirby site pure PHP, no mixed runtimes

### PHP 8.4 Type Strictness & Debugging (November 22, 2025)
**When you see 500 errors, enable debug mode IMMEDIATELY.**

**What happened:**
- All project pages returning 500 errors after template updates
- Spent hours trying different fixes (toString(), adding blueprint fields, variable scope changes)
- Made assumptions about what was wrong instead of seeing the actual error
- Finally enabled debug mode and saw: "TypeError: Unsupported operand types: string + int" on line 101

**The actual problem:**
```php
$page->title()->value() . ' - Screenshot ' . ($index + 1);
```
- The issue was `($index + 1)` - NOT the string concatenation
- In Kirby's `foreach ($page->images() as $index => $image)`, `$index` is a STRING, not int
- PHP 8.4 is VERY strict - cannot add int to string without explicit casting
- Error message "string + int" referred to the addition operator `+`, not concatenation `.`

**The fix:**
```php
$page->title()->value() . ' - Screenshot ' . ((int)$index + 1);
```

**Lessons:**
1. **Enable debug mode FIRST** - Set `'debug' => true` in config.php to see actual PHP errors, don't waste time guessing
2. **PHP 8.4 type strictness** - Always explicitly cast types when doing math operations: `(int)$index`
3. **Kirby foreach indexes are strings** - Don't assume array keys are integers, especially in CMS collections
4. **Use tools immediately** - WebSearch and Playwright should be used early when stuck, not as last resort
5. **Read error messages carefully** - "string + int" meant addition (`+`), not concatenation (`.`)
6. **Field object methods** - Use `->value()` to extract string values from Kirby Field objects

**Debugging workflow for future 500 errors:**
1. Enable debug mode: `'debug' => true` in `site/config/config.php`
2. Push to production and fetch the error JSON
3. Read the ACTUAL error message and line number
4. Search Kirby docs/forum for the specific error
5. Fix the root cause, not symptoms
6. Disable debug mode after fixing

---

## Directory Structure

```
/Users/loganherr/shimmer-labs-site/
├── assets/
│   ├── css/main.css          # All site styles
│   ├── js/main.js            # Gallery, menu, forms, lazy loading
│   └── images/               # Favicons, logos
├── content/
│   ├── home/                 # Homepage content
│   ├── projects/             # Project pages
│   │   ├── 2_off-the-apps-ok/
│   │   ├── 6_eventsnag/      # EventSnag project (featured)
│   │   └── ...
│   ├── contact/              # Contact page
│   └── ...
├── site/
│   ├── blueprints/           # Kirby admin panel schemas
│   │   └── pages/
│   │       └── project.yml   # Project page fields
│   ├── config/
│   │   └── config.php        # Main config (analytics, sitemap, etc)
│   ├── snippets/             # Reusable components
│   │   ├── header.php        # Site header with nav
│   │   ├── footer.php        # Site footer
│   │   └── app-waitlist.php  # Pre-launch waitlist form
│   └── templates/            # Page templates
│       ├── home.php          # Homepage
│       ├── projects.php      # Projects index (Featured + More)
│       ├── project.php       # Individual project pages
│       └── contact.php       # Contact form
├── kirby/                    # Kirby CMS core (don't edit)
├── vendor/                   # Composer dependencies
├── robots.txt                # SEO crawler rules
├── site.webmanifest          # PWA manifest
└── index.php                 # Entry point
```

---

## Key Files to Know

### `/site/config/config.php`
Main configuration file. Contains:
- Google Analytics 4 measurement ID
- Plausible Analytics toggle
- Dynamic sitemap.xml route
- Site URL and other global settings

### `/site/templates/project.php`
Template for individual project pages. Handles:
- Project metadata (title, summary, tech stack)
- Waitlist forms (for pre-launch apps)
- Demo videos (local files or YouTube embeds)
- Image galleries with thumbnails
- App Store links
- Legal footer (privacy, terms, support)

### `/site/snippets/app-waitlist.php`
Reusable waitlist form component. Features:
- Compact 3-line banner design
- Email collection via Formspree
- Social share buttons (Twitter, LinkedIn, Instagram)
- Success message handling
- Customizable app name and launch date

### `/assets/css/main.css`
All site styles. Key sections:
- CSS variables (`:root` section)
- Project cards (featured vs compact styles)
- Gallery (supports images, YouTube embeds, local videos)
- Waitlist banner (lines 2087-2352)
- Responsive breakpoints (@media queries at bottom)

### `/assets/js/main.js`
All site JavaScript. Key features:
- Gallery thumbnail switcher (supports local videos + YouTube)
- Image lightbox/zoom
- Menu overlay toggle
- Lazy loading images
- Form AJAX handling

---

## Recent Work (October 19, 2025)

### EventSnag Pre-Launch Waitlist
**Goal:** Collect emails before App Store approval

**What was done:**
1. Created `app-waitlist.php` snippet (compact 3-line banner)
2. Added to EventSnag project page
3. Integrated Formspree (`xnngrlnp` → logan@shimmerlabs.co)
4. Added social share buttons (Twitter, LinkedIn, Instagram)
5. Designed with early bird offer: "Scan 10 events → PRO free forever"

**Design iterations:**
- Started as large gold box (user said "laughably bad")
- Redesigned to compact banner:
  - Line 1: "🚀 Join the Waitlist | Launching: Late October 2025"
  - Line 2: Email input + "Notify Me at Launch" button
  - Line 3: "No spam, promise. • Share: [buttons]"

### EventSnag Media Gallery
**What was done:**
1. Added demo video (`eventsnag-demo.mp4`, 22MB) to project folder
2. Added app screenshots (`eventsnag-home-screen.png`, `eventsnag-events-list.png`)
3. Updated template to support local video files in gallery (not just YouTube)
4. Fixed aspect ratio handling for portrait iPhone screen recordings
5. Moved video from separate "See It In Action" section into gallery

**Video handling:**
- Local videos: `demo_video` field in blueprint
- YouTube videos: `video_url` field
- Gallery auto-detects and renders correctly
- Videos respect natural aspect ratio (portrait or landscape)

### SEO Improvements
1. Created `robots.txt` with sitemap reference
2. Added dynamic `sitemap.xml` route in config.php
3. Added `meta_description` field to all page blueprints
4. Updated header.php with smart meta tag fallbacks
5. Added Open Graph and Twitter Card tags

### Featured Projects System
**Goal:** Highlight EventSnag and Taddy API, reduce hamburger menu clutter

**What was done:**
1. Added `featured` toggle to project blueprint
2. Updated `projects.php` template with two sections:
   - Featured Projects (large cards)
   - More Projects (compact cards)
3. Marked EventSnag and Taddy API as featured

### Form Endpoint Updates
**Old:** Both forms used `mwprqqyj` (unknown email)
**New:**
- EventSnag waitlist: `xnngrlnp` → logan@shimmerlabs.co
- Contact Us: `xdkwjykz` → logan@shimmerlabs.co

### Favicon Update
- Replaced default Kirby favicon with Shimmer Labs logo
- Added all sizes: 16x16, 32x32, 180x180, 192x192, 512x512
- Updated `site.webmanifest` for PWA support

---

## Common Tasks

### Add a New Project
1. Create folder in `/content/projects/` (numbered: `7_project-name/`)
2. Add `project.txt` with frontmatter:
   ```
   Title: Project Name
   ----
   Badge: Live (or "Coming Soon", "Launching Soon")
   ----
   Summary: One-line description
   ----
   Tech_stack: Tech1, Tech2, Tech3
   ----
   Featured: false
   ----
   Description:

   Full markdown description here...
   ```
3. Add images to the same folder
4. Optionally add `demo_video` file for gallery

### Update EventSnag Status
1. Open `/content/projects/6_eventsnag/project.txt`
2. Change `Badge: Launching Soon` → `Badge: Live`
3. Update `App_store_url:` with actual App Store link
4. Remove `Demo_video:` reference if no longer needed

### Add a New Waitlist Form
1. Create Formspree form at https://formspree.io
2. Get form ID (e.g., `xnngrlnp`)
3. Use snippet in template:
   ```php
   <?php snippet('app-waitlist', [
     'app_name' => 'Your App Name',
     'formspree_id' => 'YOUR_ID_HERE',
     'launch_date' => 'Late October 2025'
   ]) ?>
   ```

### Update Analytics
Edit `/site/config/config.php`:
```php
'analytics.ga4.measurementId' => 'G-KPVHKHKJJY',
'analytics.plausible' => true,
```

---

## Deployment

**Branch:** `main`
**Auto-deploys:** Push to `main` → Digital Ocean builds and deploys automatically

**Commit format:**
```bash
git add .
git commit -m "Brief description

Details about changes...

🤖 Generated with [Claude Code](https://claude.com/claude-code)

Co-Authored-By: Claude <noreply@anthropic.com>"
git push origin main
```

---

## Important Notes

### Kirby 5 Field Methods
- Use `.toString()` instead of `.value()` for string fields
- Use `.toBool()` for toggle/checkbox fields
- Use `.kt()` to render KirbyText (markdown)
- Use `.toFile()` to get file object from files field

Example:
```php
<?php if ($page->is_app()->toBool() && $page->badge()->toString() === 'Launching Soon'): ?>
  <?php $demoVideo = $page->demo_video()->toFile(); ?>
  <video src="<?= $demoVideo->url() ?>"></video>
<?php endif ?>
```

### Gallery Video Support
- **YouTube embeds:** Use `video_url` field (e.g., `https://www.youtube.com/embed/VIDEO_ID`)
- **Local videos:** Use `demo_video` field, upload MP4/WebM/MOV
- Gallery auto-detects type and renders correctly
- Portrait videos (iPhone recordings) respect aspect ratio

### Waitlist Form Design
- Keep it compact (3 lines max)
- Subtle background: `rgba(255, 179, 0, 0.05)`
- Border: `1px solid rgba(255, 179, 0, 0.3)`
- No giant gold boxes (user hates those)

### OffTheAppsOK Instagram Posts
- Weekly roundups posted Sundays for upcoming week
- Format: Opener → Announcement → Day slides → Closer
- Announcement slide promotes EventSnag waitlist
- Post description includes link to EventSnag page

---

## Contact

**Client:** Logan Herr
**Email:** logan@shimmerlabs.co
**Role:** You're the website Claude Code instance
**Other Claude:** CurbCheck development (iOS app for parking sign translation)

---

## Next Steps / TODO

### EventSnag Launch Checklist
- [ ] User records and uploads demo video showing full app flow
- [ ] Apple Developer account approved
- [ ] App submitted to App Store
- [ ] Update `Badge: Launching Soon` → `Badge: Live`
- [ ] Add App Store URL to project.txt
- [ ] Remove waitlist, show download button
- [ ] Post launch announcement on LinkedIn + Instagram
- [ ] Monitor early bird deal redemptions (10 scans → PRO free)

### Potential Improvements
- [ ] Consider adding testimonials section to homepage
- [ ] Add blog/notes section for case studies
- [ ] Improve mobile menu animation
- [ ] Add more case studies to projects
- [ ] Consider adding video backgrounds to hero section

### Instagram Marketing
- [ ] Promote EventSnag on OffTheAppsOK (in bio, weekly posts)
- [ ] Boost posts with $20 ad budget targeting Stillwater locals
- [ ] Track waitlist signups from Instagram vs LinkedIn
- [ ] Share weekly roundups on personal LinkedIn too

---

## Session Notes (February 12, 2026)

### Lead Gen / Distribution Strategy Session

**Context:** Logan is shifting away from automation consulting (Zapier/Make/n8n) and toward building custom software for small/niche businesses. Think TreeBidPro, FlowMint (Shopify app), Velvet Fudge (local record store). He's also about to live stream vibe coding the Android version of EventSnag on TikTok.

**What we did:**
1. Researched freelance/marketplace platforms for Shimmer Labs services
2. Ranked platforms specifically for "I build custom apps for small businesses" positioning
3. Decided to set up **Google Business Profile** first (free, low competition in Stillwater)
4. Also high on the list: **Shopify Partners** (free, 20% recurring referral commission + $500 bonus per referral through Feb 2026, great fit since FlowMint is a Shopify app and Velvet Fudge could be a Shopify lead)

**Where we left off:**
- Updated Playwright MCP config to `--headed` mode (added `--headed` flag in `~/.claude.json`)
- Navigated to Google Business Profile signup (`business.google.com/create`) but hit the Google sign-in wall
- Logan needs to restart Claude Code so Playwright launches in headed mode (visible browser window) so he can type his Google password
- **Next step:** Navigate to `business.google.com/create`, Logan signs in, then we walk through the GBP setup together

**Platform rankings (for Logan's new positioning):**
1. Google Business Profile (free, dominate local search in Stillwater)
2. Shopify Partners (free, referral income, FlowMint angle)
3. TikTok live vibe coding streams (free, builds trust, direct inbound)
4. Alignable (free, where local small biz owners network)
5. Contra (0% commission, great portfolio tools)
6. Storetasker (Shopify-specific, apply once FlowMint is in App Store)
7. Chamber of Commerce (~$300/yr, face-to-face local networking)

**Key insight:** Velvet Fudge (local record store) is a perfect Shopify Partners lead — help them get on Shopify, earn 20% recurring + $500 bonus, AND become their go-to dev. Triple dip.

---

**End of Guide**
*Remember: Logan's tone is informal and slightly silly. Avoid AI corporate speak. Keep it real.*

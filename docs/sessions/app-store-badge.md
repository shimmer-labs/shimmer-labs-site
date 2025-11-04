# App Store Badge Setup

## Official Apple Badge

Download the official "Download on the App Store" badge from Apple:

**Link**: https://developer.apple.com/app-store/marketing/guidelines/#downloadOnAppstore

### Steps:
1. Go to https://developer.apple.com/app-store/marketing/guidelines/
2. Scroll to "Download on the App Store" section
3. Download the SVG badge (US English version)
4. Save as `assets/images/app-store-badge.svg`

### Specifications:
- **Format**: SVG (recommended) or PNG
- **Dimensions**: Minimum height 40px
- **Clear space**: Height of badge on all sides
- **Background**: White or light background required
- **Don't**: Modify colors, rotate, add effects, or change proportions

## Alternative: Quick Setup

If you need a placeholder while getting the official badge:

```bash
# Download directly via curl
curl -o shimmer-labs-site/assets/images/app-store-badge.svg \
  https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/en-us?size=250x83

# Or use the black/white versions
# Black: Good for light backgrounds (recommended)
# White: Good for dark backgrounds
```

## Current Implementation

The app download button (`site/snippets/app-download.php`) will:

**When `app_store_url` is empty** (Coming Soon):
- Shows a "Coming Soon" badge with phone emoji
- Text: "Available on the App Store"

**When `app_store_url` is filled**:
- Links to your App Store page
- Shows official Apple badge
- Opens in new tab

## Usage in EventSnag

The EventSnag project page (`/projects/eventsnag`) currently shows "Coming Soon" because `app_store_url` is empty.

**When app launches**, edit `content/projects/6_eventsnag/project.txt`:

```
App_store_url: https://apps.apple.com/app/eventsnag/id<YOUR_APP_ID>
```

The badge will automatically switch from "Coming Soon" to the live App Store link.

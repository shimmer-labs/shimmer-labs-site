# EventSnag Demo Video Upload Instructions

## How to Add Your Demo Video/GIF

Your EventSnag waitlist page is live! Now you just need to upload the demo video.

### Option 1: Upload via Kirby Panel (EASIEST)

1. Go to https://shimmerlabs.co/panel (your Kirby admin)
2. Navigate to **Projects** → **EventSnag**
3. Scroll to the **"Demo Video/GIF"** field
4. Click **"Add"** and upload your file:
   - `.mp4` (recommended - best quality, auto-plays)
   - `.mov` (iPhone native format)
   - `.webm` (web optimized)
   - `.gif` (works, but larger file size)
5. Click **Save**
6. The video will appear automatically on the EventSnag page!

### Option 2: Upload Manually via Content Folder

If you prefer to upload directly:

1. Record your demo on iPhone (screen recording)
2. Export/convert to `.mp4` (smaller file size)
3. Upload to: `/content/projects/6_eventsnag/`
4. Name it something like: `eventsnag-demo.mp4`
5. The system will auto-detect it

### Video Specs

**Recommended Format:**
- **Type**: MP4 (H.264 codec)
- **Duration**: 15-30 seconds (quick demo loop)
- **Resolution**: 1080x1920 (vertical phone) or 1920x1080 (horizontal)
- **File Size**: Keep under 10MB for fast loading

**What to Show:**
1. Camera → capture event flyer (2-3 sec)
2. AI parsing animation (2-3 sec)
3. Review parsed event (2-3 sec)
4. Tap "Snag It" → calendar sync (2-3 sec)
5. Show calendar with event added (2-3 sec)

**Quick Loop**: Let it auto-replay so visitors see it multiple times

### Tools to Compress Video

If your iPhone recording is too large (>10MB):

**Free Online Tools:**
- **Clipchamp** (clipchamp.com) - free, in-browser
- **HandBrake** (handbrake.fr) - desktop app, very powerful
- **CloudConvert** (cloudconvert.com) - online converter

**Settings:**
- Resolution: 720p or 1080p
- Bitrate: 2-4 Mbps
- Format: MP4 (H.264)

### Converting GIF to MP4

If you created a GIF but want MP4 (smaller file size):
```bash
# Using ffmpeg (if installed)
ffmpeg -i eventsnag-demo.gif -movflags faststart -pix_fmt yuv420p -vf "scale=trunc(iw/2)*2:trunc(ih/2)*2" eventsnag-demo.mp4
```

Or use **CloudConvert**: cloudconvert.com/gif-to-mp4

### Testing

After uploading:
1. Visit https://shimmerlabs.co/projects/eventsnag
2. You should see **"See It In Action"** section below the waitlist form
3. Video should auto-play, loop, and be muted
4. Test on mobile too!

### Current Status

✅ **Waitlist form** - LIVE (collecting emails)
✅ **Social share buttons** - LIVE (Twitter + LinkedIn)
✅ **Badge** - Changed to "Launching Soon"
✅ **Demo video section** - READY (just needs your video!)

### Next Steps

1. Record your demo (iPhone screen record)
2. Upload via Kirby Panel
3. Post on Off The Apps OK with link to waitlist
4. Watch the signups roll in! 🚀

---

**Questions?** The demo video will automatically show up once you upload it. No coding required!

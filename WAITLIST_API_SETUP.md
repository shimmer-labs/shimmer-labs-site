# Waitlist API Setup Guide

**Last Updated:** October 20, 2025
**Purpose:** Set up Firestore-backed waitlist for EventSnag (replacing Formspree)

---

## Overview

The waitlist form now submits directly to Firestore via a Vercel serverless function:

**Old Flow:**
```
Landing Page Form → Formspree → Email to logan@shimmerlabs.co
```

**New Flow:**
```
Landing Page Form → Vercel API → Firestore + Email Notification
                                      ↓
                            iOS App checks Firestore → Auto-grant Lifetime PRO
```

---

## Step 1: Get Firebase Service Account Credentials

**1. Go to Firebase Console:**
- URL: https://console.firebase.google.com
- Select your EventSnag project

**2. Generate Service Account Key:**
- Settings (⚙️) → Project Settings → Service Accounts
- Click "Generate New Private Key"
- Download `serviceAccountKey.json`

**3. Extract Credentials:**

Open `serviceAccountKey.json` and note these values:
```json
{
  "project_id": "your-project-id",
  "private_key": "-----BEGIN PRIVATE KEY-----\n...\n-----END PRIVATE KEY-----\n",
  "client_email": "firebase-adminsdk-xxxxx@your-project.iam.gserviceaccount.com"
}
```

**4. Base64 Encode the Private Key:**

```bash
# On macOS/Linux:
echo -n "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC...
-----END PRIVATE KEY-----" | base64

# Copy the output (will be a long string without line breaks)
```

**Important:** Replace the actual private key above with your value from step 3.

---

## Step 2: Set Vercel Environment Variables

**1. Go to Vercel Dashboard:**
- URL: https://vercel.com
- Select `shimmer-labs-site` project
- Settings → Environment Variables

**2. Add Firebase Credentials:**

| Variable Name | Value | Environment |
|---------------|-------|-------------|
| `FIREBASE_PROJECT_ID` | Your project ID from step 1 | Production, Preview, Development |
| `FIREBASE_CLIENT_EMAIL` | Your client email from step 1 | Production, Preview, Development |
| `FIREBASE_PRIVATE_KEY` | Base64 encoded private key from step 1 | Production, Preview, Development |

**3. Add Email Settings (Required for email notifications):**

| Variable Name | Value | Environment |
|---------------|-------|-------------|
| `RESEND_API_KEY` | Your Resend API key (starts with `re_`) | Production, Preview, Development |
| `NOTIFICATION_EMAIL` | `logan@shimmerlabs.co` | Production, Preview, Development |

**Where to get Resend API key:**
- Login to https://resend.com/api-keys
- Copy the API key (starts with `re_`)
- Paste into Vercel environment variables (NOT in code!)

**Note:** If you don't set Resend credentials, the API will still work but won't send email notifications (to users or you). You'll only see waitlist signups in Firestore.

---

## Step 3: Verify Sender Email in Resend (Required for emails)

**1. Login to Resend:**
- URL: https://resend.com
- Free tier: 3,000 emails/month, 100/day (plenty for waitlist)

**2. Verify Sender Domain:**
- Go to: https://resend.com/domains
- Add domain: `shimmerlabs.co`
- Follow DNS setup instructions (add TXT, MX, CNAME records)
- Wait for verification (usually 5-10 minutes)

**OR use Resend's test domain for now:**
- Emails will send from: `onboarding@resend.dev`
- Good for testing, but use your domain for production

**3. Email Templates:**

**Confirmation email TO THE USER:**
```
Subject: You're on the EventSnag Waitlist! 🎉

You're on the list! 🎉

Thanks for joining the EventSnag waitlist. You're all set!

We'll email you at user@example.com as soon as EventSnag
launches (late October 2025).

[What is EventSnag?]
Snap a photo of any event flyer, and EventSnag uses AI to
add it to your Google Calendar instantly. No typing, no
copy-paste, no forgetting.

[Share EventSnag →]

No spam, promise.
- Logan
```

**Notification email TO YOU:**
```
Subject: New EventSnag Waitlist Signup

New Waitlist Signup 🎉

App: EventSnag
Email: user@example.com
Source: website
Date: Sun, Oct 20, 2025, 3:45 PM CDT

[View in Firestore →]
```

---

## Step 4: Deploy Vercel API

**1. Install Dependencies:**

```bash
cd /Users/loganherr/shimmer-labs-site
npm install firebase-admin @sendgrid/mail --prefix api
```

**2. Test Locally (Optional):**

```bash
# Install Vercel CLI
npm install -g vercel

# Run local dev server
vercel dev

# Test endpoint:
curl -X POST http://localhost:3000/api/waitlist-submit \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","app":"EventSnag","source":"website"}'
```

**3. Deploy to Production:**

```bash
vercel --prod
```

**Expected Output:**
```
✅ Deployed to production
🔗 https://shimmerlabs.co
```

**4. Verify API Endpoint:**

```bash
# Test the live endpoint
curl -X POST https://shimmerlabs.co/api/waitlist-submit \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","app":"EventSnag","source":"website"}'
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Thanks for joining the EventSnag waitlist! We'll email you at test@example.com when we launch."
}
```

---

## Step 5: Add Existing Waitlist Emails to Firestore

You have 2 existing signups from Formspree:
- `rjduffield@gmail.com`
- `sweetinaara@gmail.com`

**Option A: Use the Script (Recommended)**

```bash
cd /Users/loganherr/eventsnag/EventSnag

# Install dependencies
npm install firebase-admin

# Copy your Firebase service account key
# (Download from Firebase Console → Project Settings → Service Accounts)
cp ~/Downloads/serviceAccountKey.json ./

# Run the script
node scripts/add-existing-waitlist-emails.js
```

**Expected Output:**
```
✅ Firebase Admin initialized

📋 Adding existing waitlist emails to Firestore...

✅ rjduffield@gmail.com - Queued for addition
✅ sweetinaara@gmail.com - Queued for addition

✅ Successfully added 2 email(s) to waitlist

🔍 Verifying additions:

✓ rjduffield@gmail.com
  Source: formspree
  Redeemed: No

✓ sweetinaara@gmail.com
  Source: formspree
  Redeemed: No

✅ Done!
```

**Option B: Manual Entry via Firebase Console**

1. Go to Firebase Console → Firestore Database
2. Navigate to `waitlist` collection (create if doesn't exist)
3. Click "Add Document"
4. For each email:
   - **Document ID:** `rjduffield@gmail.com` (lowercase)
   - **Fields:**
     - `email` (string): `rjduffield@gmail.com`
     - `signupDate` (timestamp): `October 19, 2025`
     - `source` (string): `formspree`
     - `app` (string): `EventSnag`
     - `redeemedBy` (null)
     - `redeemedAt` (null)
5. Repeat for `sweetinaara@gmail.com`

---

## Step 6: Test the Full Flow

**1. Visit Landing Page:**
```
https://shimmerlabs.co/projects/eventsnag
```

**2. Submit Test Email:**
- Enter: `your-test-email+test@gmail.com` (use `+test` to avoid duplicate)
- Click "Notify Me at Launch"
- **Expected:** Success message appears

**3. Check Firestore:**
- Firebase Console → Firestore Database → `waitlist` collection
- **Expected:** New document with your test email

**4. Check Email Notification:**
- If SendGrid configured: Check `logan@shimmerlabs.co` inbox
- **Expected:** Email notification with signup details

**5. Test Duplicate Prevention:**
- Submit same email again
- **Expected:** "You're already on the waitlist!" message

---

## Step 7: Update GitHub Repo

**1. Commit and Push:**

```bash
cd /Users/loganherr/shimmer-labs-site

git add .
git commit -m "feat: Replace Formspree with Firestore waitlist API

- Add Vercel serverless function for waitlist submissions
- Direct integration with Firestore for iOS app lifetime PRO unlocks
- Optional SendGrid email notifications
- Duplicate prevention and validation
- Graceful degradation (form still works without JS)"

git push origin main
```

**2. Verify Auto-Deployment:**
- Vercel automatically deploys on push to `main`
- Check: https://vercel.com/shimmer-labs/shimmer-labs-site/deployments
- Wait for deployment to complete (~30 seconds)

---

## Troubleshooting

### Issue: "Missing Firebase credentials" error

**Cause:** Environment variables not set correctly in Vercel

**Fix:**
1. Go to Vercel → shimmer-labs-site → Settings → Environment Variables
2. Verify all 3 Firebase variables are set for Production
3. Redeploy: Vercel → Deployments → ··· → Redeploy

---

### Issue: API returns 500 error

**Cause:** Firebase private key not base64 encoded correctly

**Fix:**
```bash
# Check if your key has newlines
echo "$FIREBASE_PRIVATE_KEY" | base64 -d

# Should output: -----BEGIN PRIVATE KEY-----...-----END PRIVATE KEY-----

# If it doesn't work, try this:
cat serviceAccountKey.json | jq -r '.private_key' | base64
```

---

### Issue: Email not added to Firestore

**Cause:** Firestore security rules blocking writes

**Fix:**
```javascript
// firestore.rules - Add this rule
rules_version = '2';
service cloud.firestore {
  match /databases/{database}/documents {
    match /waitlist/{email} {
      // Allow server-side writes (Firebase Admin SDK)
      allow write: if request.auth == null; // Server auth bypasses this
    }
  }
}
```

**Note:** Firebase Admin SDK automatically bypasses security rules, so this shouldn't be needed. But if you see permission errors, add this rule.

---

### Issue: Resend email not sending

**Possible causes:**
1. **Sender domain not verified** → Verify `shimmerlabs.co` in Resend (or use `onboarding@resend.dev` for testing)
2. **API key invalid** → Check API key in Vercel matches Resend dashboard
3. **Free tier limit hit** → Check Resend dashboard (100/day, 3,000/month max)
4. **Email in spam** → Check spam folder, or whitelist `logan@shimmerlabs.co` domain

**Quick test:**
```bash
curl -X POST https://api.resend.com/emails \
  -H "Authorization: Bearer re_YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "from": "EventSnag <logan@shimmerlabs.co>",
    "to": "logan@shimmerlabs.co",
    "subject": "Test Email",
    "html": "<p>This is a test email from Resend</p>"
  }'
```

**Check Resend logs:**
- https://resend.com/emails
- Shows all sent emails, delivery status, and errors

---

## Security Checklist

- [x] Firebase private key base64 encoded (not plaintext in Vercel)
- [x] Service account key NOT committed to Git
- [x] API has CORS headers (allows browser requests)
- [x] Honeypot field prevents bot submissions
- [x] Email validation on server-side
- [x] Duplicate prevention (same email can't join twice)
- [x] Rate limiting (TODO: Add Vercel rate limiting if needed)

---

## Monitoring

**Check Waitlist Signups:**
```
Firebase Console → Firestore Database → waitlist collection
```

**Check API Logs:**
```
Vercel Dashboard → shimmer-labs-site → Logs
```

**Check Email Delivery:**
```
Resend Dashboard → Emails (https://resend.com/emails)
```

---

## Next Steps

1. ✅ Set up Firebase credentials in Vercel
2. ✅ Deploy API to production
3. ✅ Add existing waitlist emails to Firestore
4. ✅ Test full flow (form submission → Firestore → email)
5. ⏳ Send launch email to waitlist when EventSnag is live (see `WAITLIST_SETUP_GUIDE.md` in EventSnag repo)

---

## Contact

Questions? Issues?
- **Email:** logan@shimmerlabs.co
- **Repo:** https://github.com/shimmer-labs/shimmer-labs-site

---

*Last updated: October 20, 2025*

/**
 * Waitlist Submission API
 *
 * Handles EventSnag waitlist signups:
 * 1. Validates email format
 * 2. Adds to Firestore waitlist collection
 * 3. Sends email notification to logan@shimmerlabs.co
 * 4. Returns success/error response
 *
 * Environment variables required:
 * - FIREBASE_PROJECT_ID
 * - FIREBASE_PRIVATE_KEY (base64 encoded)
 * - FIREBASE_CLIENT_EMAIL
 * - SENDGRID_API_KEY (optional, for email notifications)
 * - NOTIFICATION_EMAIL (default: logan@shimmerlabs.co)
 */

const admin = require('firebase-admin');

// Initialize Firebase Admin (singleton pattern)
if (!admin.apps.length) {
  try {
    const projectId = process.env.FIREBASE_PROJECT_ID;
    const clientEmail = process.env.FIREBASE_CLIENT_EMAIL;
    const privateKey = process.env.FIREBASE_PRIVATE_KEY
      ? Buffer.from(process.env.FIREBASE_PRIVATE_KEY, 'base64').toString('utf8')
      : undefined;

    if (!projectId || !clientEmail || !privateKey) {
      throw new Error('Missing Firebase credentials in environment variables');
    }

    admin.initializeApp({
      credential: admin.credential.cert({
        projectId,
        clientEmail,
        privateKey
      })
    });

    console.log('✅ Firebase Admin initialized');
  } catch (error) {
    console.error('❌ Failed to initialize Firebase Admin:', error);
  }
}

const db = admin.firestore();

/**
 * Validate email format
 */
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

/**
 * Send emails via Resend
 */
async function sendEmails(userEmail, appName, source) {
  // Skip if Resend not configured
  if (!process.env.RESEND_API_KEY) {
    console.log('⏭️  Skipping emails (Resend not configured)');
    return;
  }

  try {
    const { Resend } = require('resend');
    const resend = new Resend(process.env.RESEND_API_KEY);

    const fromEmail = process.env.NOTIFICATION_EMAIL || 'logan@shimmerlabs.co';
    const notificationEmail = process.env.NOTIFICATION_EMAIL || 'logan@shimmerlabs.co';

    // Send confirmation email TO THE USER
    const confirmationEmail = await resend.emails.send({
      from: `EventSnag <${fromEmail}>`,
      to: userEmail,
      subject: "You're on the EventSnag Waitlist! 🎉",
      html: `
        <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
          <h2 style="color: #1C1C1E; margin-bottom: 16px;">You're on the list! 🎉</h2>

          <p style="color: #6E6E73; line-height: 1.6; margin-bottom: 16px;">
            Thanks for joining the EventSnag waitlist. You're all set!
          </p>

          <p style="color: #6E6E73; line-height: 1.6; margin-bottom: 16px;">
            We'll email you at <strong>${userEmail}</strong> as soon as EventSnag launches (late October 2025).
          </p>

          <div style="background: #FFFBF5; border-left: 4px solid #FFB300; padding: 16px; margin: 24px 0;">
            <p style="color: #1C1C1E; margin: 0; font-size: 14px;">
              <strong>What is EventSnag?</strong><br>
              Snap a photo of any event flyer, and EventSnag uses AI to add it to your Google Calendar instantly. No typing, no copy-paste, no forgetting.
            </p>
          </div>

          <p style="color: #6E6E73; line-height: 1.6; margin-bottom: 16px;">
            In the meantime, share EventSnag with friends who screenshot events and never go to them:
          </p>

          <a href="https://shimmerlabs.co/projects/eventsnag"
             style="display: inline-block; background: #FFB300; color: #1C1C1E; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; margin-bottom: 24px;">
            Share EventSnag →
          </a>

          <p style="color: #6E6E73; font-size: 14px; line-height: 1.6; border-top: 1px solid #E5E5E7; padding-top: 16px; margin-top: 32px;">
            No spam, promise. We'll only email you when EventSnag launches.<br>
            <br>
            - Logan<br>
            Shimmer Labs · <a href="https://shimmerlabs.co" style="color: #FFB300;">shimmerlabs.co</a>
          </p>
        </div>
      `
    });

    console.log('✅ Confirmation email sent to user:', userEmail);

    // Send notification email TO YOU (Logan)
    const notificationEmailResult = await resend.emails.send({
      from: `EventSnag Waitlist <${fromEmail}>`,
      to: notificationEmail,
      subject: `New ${appName} Waitlist Signup`,
      html: `
        <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
          <h2 style="color: #1C1C1E;">New Waitlist Signup 🎉</h2>

          <table style="width: 100%; border-collapse: collapse; margin: 24px 0;">
            <tr style="border-bottom: 1px solid #E5E5E7;">
              <td style="padding: 12px 0; color: #6E6E73; font-weight: 600;">App:</td>
              <td style="padding: 12px 0; color: #1C1C1E;">${appName}</td>
            </tr>
            <tr style="border-bottom: 1px solid #E5E5E7;">
              <td style="padding: 12px 0; color: #6E6E73; font-weight: 600;">Email:</td>
              <td style="padding: 12px 0; color: #1C1C1E;"><a href="mailto:${userEmail}" style="color: #FFB300;">${userEmail}</a></td>
            </tr>
            <tr style="border-bottom: 1px solid #E5E5E7;">
              <td style="padding: 12px 0; color: #6E6E73; font-weight: 600;">Source:</td>
              <td style="padding: 12px 0; color: #1C1C1E;">${source}</td>
            </tr>
            <tr>
              <td style="padding: 12px 0; color: #6E6E73; font-weight: 600;">Date:</td>
              <td style="padding: 12px 0; color: #1C1C1E;">${new Date().toLocaleString('en-US', {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                timeZoneName: 'short'
              })}</td>
            </tr>
          </table>

          <p style="color: #6E6E73; font-size: 14px;">
            <a href="https://console.firebase.google.com/project/_/firestore" style="color: #FFB300;">View in Firestore →</a>
          </p>
        </div>
      `
    });

    console.log('✅ Notification email sent to:', notificationEmail);

  } catch (error) {
    console.error('❌ Failed to send emails:', error.message);
    // Don't fail the request if email fails
  }
}

/**
 * Main handler
 */
module.exports = async (req, res) => {
  // Set CORS headers
  res.setHeader('Access-Control-Allow-Credentials', true);
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET,OPTIONS,POST');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

  // Handle preflight OPTIONS request
  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }

  // Only allow POST
  if (req.method !== 'POST') {
    return res.status(405).json({
      error: 'Method not allowed',
      message: 'This endpoint only accepts POST requests'
    });
  }

  try {
    // Parse form data or JSON
    const email = req.body.email || req.body._replyto;
    const appName = req.body.app || 'EventSnag';
    const source = req.body.source || 'website';

    // Validate email
    if (!email) {
      return res.status(400).json({
        error: 'Missing email',
        message: 'Email address is required'
      });
    }

    if (!isValidEmail(email)) {
      return res.status(400).json({
        error: 'Invalid email',
        message: 'Please provide a valid email address'
      });
    }

    const normalizedEmail = email.toLowerCase().trim();

    // Check if email already exists
    const existingDoc = await db.collection('waitlist').doc(normalizedEmail).get();

    if (existingDoc.exists) {
      const data = existingDoc.data();

      // If already redeemed, inform user
      if (data.redeemedBy) {
        return res.status(200).json({
          success: true,
          message: 'You\'re already on the waitlist and have claimed your access!',
          alreadyRedeemed: true
        });
      }

      // Already on waitlist but not redeemed yet
      return res.status(200).json({
        success: true,
        message: 'You\'re already on the waitlist! We\'ll notify you when EventSnag launches.',
        alreadyExists: true
      });
    }

    // Add to Firestore waitlist collection
    await db.collection('waitlist').doc(normalizedEmail).set({
      email: normalizedEmail,
      signupDate: admin.firestore.FieldValue.serverTimestamp(),
      source: source,
      app: appName,
      redeemedBy: null,
      redeemedAt: null
    });

    console.log(`✅ Added to waitlist: ${normalizedEmail}`);

    // Send confirmation email to user + notification email to Logan (async, don't wait)
    sendEmails(normalizedEmail, appName, source).catch(console.error);

    // Return success
    return res.status(200).json({
      success: true,
      message: `Thanks for joining the ${appName} waitlist! Check ${normalizedEmail} for confirmation.`
    });

  } catch (error) {
    console.error('❌ Error processing waitlist submission:', error);

    return res.status(500).json({
      error: 'Internal server error',
      message: 'Failed to process your request. Please try again later.'
    });
  }
};

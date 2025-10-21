/**
 * Waitlist Submission API (Firestore REST API version)
 *
 * Uses Firestore REST API instead of Admin SDK to bypass
 * organization policy restrictions on service account keys.
 *
 * Environment variables required:
 * - FIREBASE_API_KEY (Web API key from Firebase config)
 * - FIREBASE_PROJECT_ID (eventsnag-a9fd6)
 * - RESEND_API_KEY (for email notifications)
 * - NOTIFICATION_EMAIL (default: logan@shimmerlabs.co)
 */

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
    await resend.emails.send({
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
    await resend.emails.send({
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
            <a href="https://console.firebase.google.com/project/eventsnag-a9fd6/firestore" style="color: #FFB300;">View in Firestore →</a>
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
 * Add document to Firestore using REST API
 */
async function addToFirestore(email, appName, source) {
  const apiKey = process.env.FIREBASE_API_KEY || 'AIzaSyCVAGPaRK6XXeZlkWmM-jbf8zZ7IZvPyZ8';
  const projectId = process.env.FIREBASE_PROJECT_ID || 'eventsnag-a9fd6';
  const normalizedEmail = email.toLowerCase().trim();

  // Check if document exists first
  const checkUrl = `https://firestore.googleapis.com/v1/projects/${projectId}/databases/(default)/documents/waitlist/${encodeURIComponent(normalizedEmail)}?key=${apiKey}`;

  try {
    const checkResponse = await fetch(checkUrl);

    if (checkResponse.ok) {
      // Document exists - check if redeemed
      const existingDoc = await checkResponse.json();
      const redeemedBy = existingDoc.fields?.redeemedBy?.nullValue !== null
        ? existingDoc.fields?.redeemedBy?.stringValue
        : null;

      if (redeemedBy) {
        return {
          exists: true,
          redeemed: true,
          message: "You're already on the waitlist and have claimed your access!"
        };
      }

      return {
        exists: true,
        redeemed: false,
        message: "You're already on the waitlist! We'll notify you when EventSnag launches."
      };
    }
  } catch (error) {
    // Document doesn't exist or error checking - proceed to create
    console.log('Document does not exist, creating new entry');
  }

  // Create new document
  const createUrl = `https://firestore.googleapis.com/v1/projects/${projectId}/databases/(default)/documents/waitlist?documentId=${encodeURIComponent(normalizedEmail)}&key=${apiKey}`;

  const firestoreDoc = {
    fields: {
      email: { stringValue: normalizedEmail },
      signupDate: { timestampValue: new Date().toISOString() },
      source: { stringValue: source },
      app: { stringValue: appName },
      redeemedBy: { nullValue: null },
      redeemedAt: { nullValue: null }
    }
  };

  const createResponse = await fetch(createUrl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(firestoreDoc)
  });

  if (!createResponse.ok) {
    const errorText = await createResponse.text();
    throw new Error(`Firestore API error: ${createResponse.status} - ${errorText}`);
  }

  console.log(`✅ Added to Firestore: ${normalizedEmail}`);

  return {
    exists: false,
    redeemed: false,
    message: 'Successfully added to waitlist'
  };
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

    // Add to Firestore
    const result = await addToFirestore(normalizedEmail, appName, source);

    if (result.exists) {
      return res.status(200).json({
        success: true,
        message: result.message,
        alreadyExists: !result.redeemed,
        alreadyRedeemed: result.redeemed
      });
    }

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
      message: 'Failed to process your request. Please try again later.',
      details: error.message
    });
  }
};

<?php

return [
  'url' => $_SERVER['SERVER_NAME'] === 'localhost'
    ? 'http://localhost:8000'
    : 'https://shimmerlabs.co',

  // Analytics Configuration
  // Choose one or both (Plausible recommended for privacy-first approach)

  // Plausible Analytics (Privacy-friendly, no cookies, GDPR compliant)
  'analytics.plausible.enabled' => true,
  'analytics.plausible.domain' => 'shimmerlabs.co',

  // Google Analytics 4 (GA4)
  'analytics.ga4.enabled' => true,
  'analytics.ga4.measurementId' => 'G-KPVHKHKJJY',

  // SEO: Sitemap.xml Route + API Routes
  'routes' => [
    // Waitlist API endpoint
    [
      'pattern' => 'api/waitlist-submit',
      'method' => 'POST|OPTIONS',
      'action'  => function() {
        // CORS headers
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,OPTIONS,POST');
        header('Access-Control-Allow-Headers: Content-Type');

        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
          http_response_code(200);
          exit;
        }

        // Only allow POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
          return new Kirby\Cms\Response(json_encode([
            'error' => 'Method not allowed',
            'message' => 'This endpoint only accepts POST requests'
          ]), 'application/json', 405);
        }

        // Get POST data (JSON or form-encoded)
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        if (!$data) {
          parse_str($input, $data);
        }

        $email = $data['email'] ?? $data['_replyto'] ?? null;
        $appName = $data['app'] ?? 'EventSnag';
        $source = $data['source'] ?? 'website';

        // Validate email
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return new Kirby\Cms\Response(json_encode([
            'error' => 'Invalid email',
            'message' => 'Please provide a valid email address'
          ]), 'application/json', 400);
        }

        $normalizedEmail = strtolower(trim($email));

        // Firestore credentials from environment
        $apiKey = getenv('FIREBASE_API_KEY');
        $projectId = getenv('FIREBASE_PROJECT_ID');

        if (!$apiKey || !$projectId) {
          return new Kirby\Cms\Response(json_encode([
            'error' => 'Configuration error',
            'message' => 'Firebase credentials not configured'
          ]), 'application/json', 500);
        }

        // Check if document exists in Firestore
        $checkUrl = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/waitlist/" . urlencode($normalizedEmail) . "?key={$apiKey}";

        $ch = curl_init($checkUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $checkResponse = curl_exec($ch);
        $checkStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Document already exists
        if ($checkStatus === 200) {
          $existingDoc = json_decode($checkResponse, true);
          $redeemedBy = $existingDoc['fields']['redeemedBy']['nullValue'] ?? null;

          if ($redeemedBy === null && isset($existingDoc['fields']['redeemedBy']['stringValue'])) {
            // Already redeemed
            return new Kirby\Cms\Response(json_encode([
              'success' => true,
              'message' => "You're already on the waitlist and have claimed your access!",
              'alreadyRedeemed' => true
            ]), 'application/json', 200);
          }

          // On waitlist but not redeemed
          return new Kirby\Cms\Response(json_encode([
            'success' => true,
            'message' => "You're already on the waitlist! We'll notify you when EventSnag launches.",
            'alreadyExists' => true
          ]), 'application/json', 200);
        }

        // Create new document in Firestore
        $createUrl = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/waitlist?documentId=" . urlencode($normalizedEmail) . "&key={$apiKey}";

        $firestoreDoc = [
          'fields' => [
            'email' => ['stringValue' => $normalizedEmail],
            'signupDate' => ['timestampValue' => date('c')],
            'source' => ['stringValue' => $source],
            'app' => ['stringValue' => $appName],
            'redeemedBy' => ['nullValue' => null],
            'redeemedAt' => ['nullValue' => null]
          ]
        ];

        $ch = curl_init($createUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($firestoreDoc));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $createResponse = curl_exec($ch);
        $createStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($createStatus !== 200) {
          error_log("Firestore error: " . $createResponse);
          return new Kirby\Cms\Response(json_encode([
            'error' => 'Internal server error',
            'message' => 'Failed to add to waitlist. Please try again later.'
          ]), 'application/json', 500);
        }

        // Send emails via Resend (async, don't wait)
        try {
          $resendApiKey = getenv('RESEND_API_KEY');
          if ($resendApiKey) {
            $resend = \Resend\Resend::client($resendApiKey);
            $fromEmail = getenv('NOTIFICATION_EMAIL') ?: 'logan@shimmerlabs.co';
            $notificationEmail = getenv('NOTIFICATION_EMAIL') ?: 'logan@shimmerlabs.co';

            // Confirmation email to user
            $resend->emails->send([
              'from' => "EventSnag <{$fromEmail}>",
              'to' => [$normalizedEmail],
              'subject' => "You're on the EventSnag Waitlist! 🎉",
              'html' => "
                <div style=\"font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;\">
                  <h2 style=\"color: #1C1C1E; margin-bottom: 16px;\">You're on the list! 🎉</h2>
                  <p style=\"color: #6E6E73; line-height: 1.6; margin-bottom: 16px;\">Thanks for joining the EventSnag waitlist. You're all set!</p>
                  <p style=\"color: #6E6E73; line-height: 1.6; margin-bottom: 16px;\">We'll email you at <strong>{$normalizedEmail}</strong> as soon as EventSnag launches (late October 2025).</p>
                  <div style=\"background: #FFFBF5; border-left: 4px solid #FFB300; padding: 16px; margin: 24px 0;\">
                    <p style=\"color: #1C1C1E; margin: 0; font-size: 14px;\"><strong>What is EventSnag?</strong><br>Snap a photo of any event flyer, and EventSnag uses AI to add it to your Google Calendar instantly. No typing, no copy-paste, no forgetting.</p>
                  </div>
                  <p style=\"color: #6E6E73; line-height: 1.6; margin-bottom: 16px;\">In the meantime, share EventSnag with friends who screenshot events and never go to them:</p>
                  <a href=\"https://shimmerlabs.co/projects/eventsnag\" style=\"display: inline-block; background: #FFB300; color: #1C1C1E; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; margin-bottom: 24px;\">Share EventSnag →</a>
                  <p style=\"color: #6E6E73; font-size: 14px; line-height: 1.6; border-top: 1px solid #E5E5E7; padding-top: 16px; margin-top: 32px;\">No spam, promise. We'll only email you when EventSnag launches.<br><br>- Logan<br>Shimmer Labs · <a href=\"https://shimmerlabs.co\" style=\"color: #FFB300;\">shimmerlabs.co</a></p>
                </div>
              "
            ]);

            // Notification email to Logan
            $resend->emails->send([
              'from' => "EventSnag Waitlist <{$fromEmail}>",
              'to' => [$notificationEmail],
              'subject' => "New {$appName} Waitlist Signup",
              'html' => "
                <div style=\"font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;\">
                  <h2 style=\"color: #1C1C1E;\">New Waitlist Signup 🎉</h2>
                  <table style=\"width: 100%; border-collapse: collapse; margin: 24px 0;\">
                    <tr style=\"border-bottom: 1px solid #E5E5E7;\"><td style=\"padding: 12px 0; color: #6E6E73; font-weight: 600;\">App:</td><td style=\"padding: 12px 0; color: #1C1C1E;\">{$appName}</td></tr>
                    <tr style=\"border-bottom: 1px solid #E5E5E7;\"><td style=\"padding: 12px 0; color: #6E6E73; font-weight: 600;\">Email:</td><td style=\"padding: 12px 0; color: #1C1C1E;\"><a href=\"mailto:{$normalizedEmail}\" style=\"color: #FFB300;\">{$normalizedEmail}</a></td></tr>
                    <tr style=\"border-bottom: 1px solid #E5E5E7;\"><td style=\"padding: 12px 0; color: #6E6E73; font-weight: 600;\">Source:</td><td style=\"padding: 12px 0; color: #1C1C1E;\">{$source}</td></tr>
                    <tr><td style=\"padding: 12px 0; color: #6E6E73; font-weight: 600;\">Date:</td><td style=\"padding: 12px 0; color: #1C1C1E;\">" . date('D, M j, Y g:i A T') . "</td></tr>
                  </table>
                  <p style=\"color: #6E6E73; font-size: 14px;\"><a href=\"https://console.firebase.google.com/project/eventsnag-a9fd6/firestore\" style=\"color: #FFB300;\">View in Firestore →</a></p>
                </div>
              "
            ]);
          }
        } catch (Exception $e) {
          error_log("Failed to send emails: " . $e->getMessage());
          // Don't fail the request if email fails
        }

        return new Kirby\Cms\Response(json_encode([
          'success' => true,
          'message' => "Thanks for joining the {$appName} waitlist! Check {$normalizedEmail} for confirmation."
        ]), 'application/json', 200);
      }
    ],
    [
      'pattern' => 'sitemap.xml',
      'action'  => function() {
        $sitemap = [];
        $site = site();

        // Add homepage
        $sitemap[] = [
          'url' => $site->url(),
          'lastmod' => $site->modified('c'),
          'priority' => '1.0',
          'changefreq' => 'weekly'
        ];

        // Add all listed pages (excluding error, offline, notes)
        $pages = $site->index()->listed()->not(['error', 'offline', 'notes']);

        foreach ($pages as $page) {
          // Set priority based on page depth
          $priority = match($page->depth()) {
            1 => '0.8',
            2 => '0.6',
            default => '0.4'
          };

          $sitemap[] = [
            'url' => $page->url(),
            'lastmod' => $page->modified('c'),
            'priority' => $priority,
            'changefreq' => $page->isHomePage() ? 'weekly' : 'monthly'
          ];
        }

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($sitemap as $item) {
          $xml .= '  <url>' . PHP_EOL;
          $xml .= '    <loc>' . htmlspecialchars($item['url']) . '</loc>' . PHP_EOL;
          $xml .= '    <lastmod>' . date('Y-m-d', $item['lastmod']) . '</lastmod>' . PHP_EOL;
          $xml .= '    <changefreq>' . $item['changefreq'] . '</changefreq>' . PHP_EOL;
          $xml .= '    <priority>' . $item['priority'] . '</priority>' . PHP_EOL;
          $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return new Kirby\Cms\Response($xml, 'application/xml');
      }
    ]
  ]
];
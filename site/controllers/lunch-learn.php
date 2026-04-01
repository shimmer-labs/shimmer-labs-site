<?php

return function ($page, $kirby) {
    $success = get('success') === 'true';
    $error   = null;

    if ($kirby->request()->method() === 'POST') {
        $name      = trim($_POST['name'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $company   = trim($_POST['company'] ?? '');
        $jobTitle  = trim($_POST['job_title'] ?? '');
        $challenge = trim($_POST['challenge'] ?? '');

        // Honeypot — if filled, it's a bot. Fake success so they don't retry.
        if (!empty($_POST['website_url'] ?? '')) {
            go($page->url() . '?success=true');
        }

        // Basic validation
        if (!$name || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please fill in your name and a valid work email.';
            return compact('success', 'error');
        }

        // --- Rate limiting & duplicate check (file-based) ---
        $rateLimitDir = $kirby->root('index') . '/site/cache/ratelimit';
        if (!is_dir($rateLimitDir)) {
            mkdir($rateLimitDir, 0755, true);
        }

        // Rate limit by IP: max 3 submissions per hour
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $ipFile = $rateLimitDir . '/ip_' . md5($ip) . '.json';
        $ipData = file_exists($ipFile) ? json_decode(file_get_contents($ipFile), true) : [];
        $oneHourAgo = time() - 3600;
        $ipData = array_filter($ipData, fn($ts) => $ts > $oneHourAgo);
        if (count($ipData) >= 3) {
            $error = 'Too many signups from this connection. Please try again later or email logan@shimmerlabs.co directly.';
            return compact('success', 'error');
        }

        // Duplicate email check
        $emailFile = $rateLimitDir . '/emails.json';
        $registeredEmails = file_exists($emailFile) ? json_decode(file_get_contents($emailFile), true) : [];
        $emailLower = strtolower($email);
        if (in_array($emailLower, $registeredEmails)) {
            $error = "That email is already registered. Check your inbox for the confirmation, or email logan@shimmerlabs.co if you need help.";
            return compact('success', 'error');
        }

        // Load Resend API key from .env
        $apiKey = getenv('RESEND_API_KEY');
        if (!$apiKey) {
            $envFile = $kirby->root('index') . '/.env';
            if (file_exists($envFile)) {
                foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                    if (str_starts_with($line, '#')) continue;
                    if (str_starts_with($line, 'RESEND_API_KEY=')) {
                        $apiKey = substr($line, strlen('RESEND_API_KEY='));
                        break;
                    }
                }
            }
        }

        if (!$apiKey) {
            $error = 'Email service not configured. Please contact logan@shimmerlabs.co directly.';
            return compact('success', 'error');
        }

        // Generate .ics calendar invite
        $uid       = uniqid('workit-ll-') . '@shimmerlabs.co';
        $now       = gmdate('Ymd\THis\Z');
        // April 8, 2026 Noon-1PM CDT (UTC-5) = 17:00-18:00 UTC
        $dtStart   = '20260408T170000Z';
        $dtEnd     = '20260408T180000Z';

        $icsContent = "BEGIN:VCALENDAR\r\n"
            . "VERSION:2.0\r\n"
            . "PRODID:-//Shimmer Labs//Lunch and Learn//EN\r\n"
            . "CALSCALE:GREGORIAN\r\n"
            . "METHOD:REQUEST\r\n"
            . "BEGIN:VEVENT\r\n"
            . "UID:{$uid}\r\n"
            . "DTSTAMP:{$now}\r\n"
            . "DTSTART:{$dtStart}\r\n"
            . "DTEND:{$dtEnd}\r\n"
            . "SUMMARY:Lunch & Learn: Too Many Hats\\, Not Enough Hours\r\n"
            . "DESCRIPTION:AI Agents for Small Business — presented by Logan Shimmer\\, Shimmer Labs.\\n\\nLunch provided by Bao House. Bring your challenges and questions.\\n\\nWorkIT Coworking Center\\n901 S. Main St\\, Stillwater\\, OK\r\n"
            . "LOCATION:WorkIT Coworking Center\\, 901 S. Main St\\, Stillwater\\, OK 74074\r\n"
            . "ORGANIZER;CN=Logan Shimmer:mailto:logan@shimmerlabs.co\r\n"
            . "STATUS:CONFIRMED\r\n"
            . "END:VEVENT\r\n"
            . "END:VCALENDAR\r\n";

        // Compose confirmation email HTML (escape all user input)
        $name      = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $email     = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $company   = htmlspecialchars($company ?: '—', ENT_QUOTES, 'UTF-8');
        $jobTitle  = htmlspecialchars($jobTitle ?: '—', ENT_QUOTES, 'UTF-8');
        $challenge = htmlspecialchars($challenge ?: '—', ENT_QUOTES, 'UTF-8');
        $firstName = explode(' ', $name)[0];
        $emailHtml = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="margin:0; padding:0; background:#f8f7f2; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
  <div style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:8px; overflow:hidden; margin-top:20px; margin-bottom:20px;">

    <div style="background:linear-gradient(135deg, #503AA8, #9B51E0); padding:32px 40px; text-align:center;">
      <h1 style="color:#ffffff; font-size:24px; margin:0 0 4px 0;">You're in, {$firstName}!</h1>
      <p style="color:rgba(255,255,255,0.85); font-size:14px; margin:0;">Your spot is reserved.</p>
    </div>

    <div style="padding:32px 40px;">
      <h2 style="color:#0A1A2F; font-size:18px; margin:0 0 20px 0;">Too Many Hats, Not Enough Hours: Winning with Agentic AI</h2>

      <table style="width:100%; border-collapse:collapse; margin-bottom:24px;">
        <tr>
          <td style="padding:8px 0; color:#6B7280; width:100px;">When</td>
          <td style="padding:8px 0; color:#0A1A2F; font-weight:600;">Wednesday, April 8th — Noon to 1:00 PM</td>
        </tr>
        <tr>
          <td style="padding:8px 0; color:#6B7280;">Where</td>
          <td style="padding:8px 0; color:#0A1A2F; font-weight:600;">WorkIT Coworking Center<br><span style="font-weight:400;">901 S. Main St, Stillwater, OK</span></td>
        </tr>
        <tr>
          <td style="padding:8px 0; color:#6B7280;">Lunch</td>
          <td style="padding:8px 0; color:#0A1A2F; font-weight:600;">Provided by Bao House</td>
        </tr>
        <tr>
          <td style="padding:8px 0; color:#6B7280;">Parking</td>
          <td style="padding:8px 0; color:#0A1A2F;">Street parking available</td>
        </tr>
      </table>

      <div style="background:#f8f7f2; border-left:4px solid #FDBE34; padding:16px 20px; border-radius:0 8px 8px 0; margin-bottom:24px;">
        <p style="margin:0; color:#0A1A2F; font-size:14px;"><strong>Come prepared:</strong> Think about the repetitive tasks eating up your week. We'll be working through a hands-on exercise, and you might just win a free consultation + custom action plan ($500 value).</p>
      </div>

      <p style="color:#0A1A2F; font-size:14px; line-height:1.6; margin-bottom:24px;">A calendar invite is attached to this email — add it now so you don't forget.</p>

      <p style="color:#0A1A2F; font-size:14px; line-height:1.6;">See you there,<br><strong>Logan Shimmer</strong><br><span style="color:#6B7280;">Shimmer Labs &middot; logan@shimmerlabs.co</span></p>
    </div>

    <div style="background:#f0eee6; padding:20px 40px; border-top:1px solid #e0ddd4;">
      <p style="color:#6B7280; font-size:11px; margin:0 0 8px 0; text-transform:uppercase; letter-spacing:0.05em;">Registration Details</p>
      <table style="width:100%; border-collapse:collapse;">
        <tr><td style="padding:3px 0; color:#6B7280; font-size:13px; width:90px;">Name</td><td style="padding:3px 0; color:#0A1A2F; font-size:13px;">{$name}</td></tr>
        <tr><td style="padding:3px 0; color:#6B7280; font-size:13px;">Email</td><td style="padding:3px 0; color:#0A1A2F; font-size:13px;">{$email}</td></tr>
        <tr><td style="padding:3px 0; color:#6B7280; font-size:13px;">Company</td><td style="padding:3px 0; color:#0A1A2F; font-size:13px;">{$company}</td></tr>
        <tr><td style="padding:3px 0; color:#6B7280; font-size:13px;">Title</td><td style="padding:3px 0; color:#0A1A2F; font-size:13px;">{$jobTitle}</td></tr>
        <tr><td style="padding:3px 0; color:#6B7280; font-size:13px; vertical-align:top;">Challenge</td><td style="padding:3px 0; color:#0A1A2F; font-size:13px;">{$challenge}</td></tr>
      </table>
    </div>

    <div style="background:#0A1A2F; padding:20px 40px; text-align:center;">
      <p style="color:rgba(255,255,255,0.6); font-size:12px; margin:0;">Shimmer Labs &middot; Stillwater, OK &middot; shimmerlabs.co</p>
    </div>
  </div>
</body>
</html>
HTML;

        // Send via Resend API
        $payload = json_encode([
            'from'        => 'Logan Shimmer <logan@shimmerlabs.co>',
            'to'          => [$email],
            'cc'          => ['logan@shimmerlabs.co'],
            'subject'     => "You're in! Lunch & Learn at WorkIT — April 8th",
            'html'        => $emailHtml,
            'attachments' => [
                [
                    'filename' => 'lunch-learn-workit.ics',
                    'content'  => base64_encode($icsContent),
                ]
            ],
        ]);

        $ch = curl_init('https://api.resend.com/emails');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
            ],
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_TIMEOUT        => 10,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            // Record successful submission for rate limiting
            $ipData[] = time();
            file_put_contents($ipFile, json_encode($ipData));
            $registeredEmails[] = $emailLower;
            file_put_contents($emailFile, json_encode(array_unique($registeredEmails)));

            go($page->url() . '?success=true');
        } else {
            $error = 'Something went wrong sending your confirmation. Please try again or email logan@shimmerlabs.co directly.';
        }
    }

    return compact('success', 'error');
};

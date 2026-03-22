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

        // Basic validation
        if (!$name || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please fill in your name and a valid work email.';
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

        // Compose confirmation email HTML
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
            go($page->url() . '?success=true');
        } else {
            $error = 'Something went wrong sending your confirmation. Please try again or email logan@shimmerlabs.co directly.';
        }
    }

    return compact('success', 'error');
};

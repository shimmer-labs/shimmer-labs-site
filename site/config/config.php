<?php

return [
  'debug' => false,
  'url' => $_SERVER['SERVER_NAME'] === 'localhost'
    ? 'http://localhost:8000'
    : 'https://shimmerlabs.co',

  // Analytics Configuration

  // Plausible Analytics (Disabled - no account setup)
  'analytics.plausible.enabled' => false,
  'analytics.plausible.domain' => 'shimmerlabs.co',

  // Google Analytics 4 (GA4)
  'analytics.ga4.enabled' => true,
  'analytics.ga4.measurementId' => 'G-KPVHKHKJJY',

  // Scanner API proxy — routes through same origin so Firefox Enhanced
  // Tracking Protection doesn't block cross-origin requests to scanner.shimmerlabs.co
  'scanner.api.url' => 'https://scanner.shimmerlabs.co',

  // Scanner proxy helper — forwards requests to scanner.shimmerlabs.co
  'scanner.proxy' => function($path = '') {
    $base = option('scanner.api.url') . '/api/scan';
    $scannerUrl = $path ? $base . '/' . $path : $base;

    $ch = curl_init($scannerUrl);
    $opts = [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT        => 60,
      CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'X-Forwarded-For: ' . ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? ''),
      ],
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $opts[CURLOPT_POST] = true;
      $opts[CURLOPT_POSTFIELDS] = file_get_contents('php://input');
    }

    curl_setopt_array($ch, $opts);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error    = curl_error($ch);
    curl_close($ch);

    if ($error) {
      return new Kirby\Cms\Response(
        json_encode(['error' => 'Scanner unavailable']),
        'application/json',
        502
      );
    }
    return new Kirby\Cms\Response($response, 'application/json', $httpCode);
  },

  // ─── GHL guide-lead intake ────────────────────────────────────────
  // Reads an env var (getenv first, then the .env file). Inbound-webhook
  // URLs live in .env so they stay out of git.
  'ghl.env' => function (string $key, string $default = '') {
    $val = getenv($key);
    if ($val !== false && $val !== '') {
      return $val;
    }
    $envFile = kirby()->root('index') . '/.env';
    if (is_file($envFile)) {
      foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if ($line === '' || $line[0] === '#') {
          continue;
        }
        if (str_starts_with($line, $key . '=')) {
          return trim(substr($line, strlen($key) + 1));
        }
      }
    }
    return $default;
  },

  // Each guide maps to its own GHL inbound webhook (env var) and tag.
  'ghl.guides' => [
    'ai-agents-small-business' => [
      'env'   => 'GHL_WEBHOOK_AI_AGENTS',
      'tag'   => 'guide-ai-agents',
      'label' => 'AI Agents for Small Business',
    ],
    'ai-security-business' => [
      'env'   => 'GHL_WEBHOOK_AI_SECURITY_BUSINESS',
      'tag'   => 'guide-ai-security-business',
      'label' => 'AI Security for Business',
    ],
    'ai-security-education' => [
      'env'   => 'GHL_WEBHOOK_AI_SECURITY_EDUCATION',
      'tag'   => 'guide-ai-security-education',
      'label' => 'AI Security for Higher Education',
    ],
  ],

  'ghl.teamSizes' => ['Just me', '2-10', '11-25', '26-50', '51-100', '100+'],

  // Validates a guide-form submission and forwards it to the matching GHL
  // inbound webhook. Always returns a JSON response.
  'ghl.lead' => function () {
    $json = fn($data, $code = 200) => new Kirby\Cms\Response(json_encode($data), 'application/json', $code);

    try {
    $body = json_decode(file_get_contents('php://input'), true);
    if (!is_array($body)) {
      return $json(['ok' => false, 'error' => 'Invalid request.'], 400);
    }

    // Honeypot: a real user never fills this. Silently accept so bots stop.
    if (trim((string)($body['company_url'] ?? '')) !== '') {
      return $json(['ok' => true]);
    }

    $clean = fn($v) => trim(preg_replace('/[\x00-\x1F\x7F]+/u', ' ', (string)($v ?? '')));
    $firstName  = $clean($body['first_name'] ?? '');
    $email      = strtolower($clean($body['email'] ?? ''));
    $business   = $clean($body['business'] ?? '');
    $teamSize   = $clean($body['team_size'] ?? '');
    $intent     = $clean($body['intent'] ?? '');
    $guideSlug  = $clean($body['guide'] ?? '');
    $sourcePage = substr(preg_replace('~[^a-z0-9/_-]~i', '', (string)($body['source_page'] ?? '')), 0, 120);

    // Required-field + format validation.
    $errors = [];
    if ($firstName === '' || mb_strlen($firstName) > 100) {
      $errors[] = 'first_name';
    }
    if ($email === '' || mb_strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'email';
    }
    if (mb_strlen($business) < 2 || mb_strlen($business) > 200) {
      $errors[] = 'business';
    }
    if (!in_array($teamSize, option('ghl.teamSizes'), true)) {
      $errors[] = 'team_size';
    }
    if ($intent === '' || mb_strlen($intent) > 200) {
      $errors[] = 'intent';
    }
    $guides = option('ghl.guides');
    if (!isset($guides[$guideSlug])) {
      $errors[] = 'guide';
    }
    if (!empty($errors)) {
      return $json(['ok' => false, 'error' => 'Please double-check the form and try again.', 'fields' => $errors], 422);
    }

    // Rate limit by IP: 5 per hour.
    $dir = kirby()->root('index') . '/site/cache/ratelimit';
    if (!is_dir($dir)) {
      @mkdir($dir, 0755, true);
    }
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $ip = trim(explode(',', $ip)[0]);
    $ipFile = $dir . '/lead_ip_' . md5($ip) . '.json';
    $hits = is_file($ipFile) ? (json_decode(file_get_contents($ipFile), true) ?: []) : [];
    $cutoff = time() - 3600;
    $hits = array_values(array_filter($hits, fn($t) => $t > $cutoff));
    if (count($hits) >= 5) {
      return $json(['ok' => false, 'error' => 'Too many submissions from this connection. Please try again later or email logan@shimmerlabs.co.'], 429);
    }

    // Resolve the destination webhook.
    $guide   = $guides[$guideSlug];
    $webhook = option('ghl.env')($guide['env']);
    if (!str_starts_with($webhook, 'https://')) {
      error_log('[ghl.lead] Missing/invalid webhook for ' . $guideSlug . ' (' . $guide['env'] . ')');
      return $json(['ok' => false, 'error' => 'We could not process that just now. Please email logan@shimmerlabs.co and we will send the guide.'], 503);
    }

    // A single token that looks like a domain/URL is treated as the website.
    $website = '';
    if (strpos($business, ' ') === false &&
        preg_match('~^(https?://)?(www\.)?[a-z0-9-]+(\.[a-z0-9-]+)+([/?#].*)?$~i', $business)) {
      $website = preg_match('~^https?://~i', $business) ? $business : 'https://' . $business;
    }

    $payload = [
      'first_name'    => mb_substr($firstName, 0, 100),
      'email'         => $email,
      'business_name' => mb_substr($business, 0, 200),
      'website'       => $website,
      'team_size'     => $teamSize,
      'lead_intent'   => mb_substr($intent, 0, 200),
      'guide'         => $guideSlug,
      'guide_label'   => $guide['label'],
      'guide_tag'     => $guide['tag'],
      'source_page'   => $sourcePage,
      'source'        => 'Website guide: ' . $guide['label'],
    ];

    $ch = curl_init($webhook);
    curl_setopt_array($ch, [
      CURLOPT_POST           => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT        => 8,
      CURLOPT_CONNECTTIMEOUT => 4,
      CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
      CURLOPT_POSTFIELDS     => json_encode($payload),
    ]);
    $resp = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $cErr = curl_error($ch);
    curl_close($ch);

    if ($cErr || $code < 200 || $code >= 300) {
      error_log('[ghl.lead] Webhook ' . $code . ' for ' . $guideSlug . ': ' . $cErr . ' ' . substr((string)$resp, 0, 200));
      return $json(['ok' => false, 'error' => 'Something went wrong sending your guide. Please email logan@shimmerlabs.co and we will get it to you.'], 502);
    }

    $hits[] = time();
    @file_put_contents($ipFile, json_encode($hits));

    return $json(['ok' => true]);
    } catch (\Throwable $e) {
      error_log('[ghl.lead] EXCEPTION ' . $e->getMessage());
      return $json(['ok' => false, 'error' => 'Something went wrong. Please email logan@shimmerlabs.co.'], 500);
    }
  },

  // Routes
  'routes' => [
    // /_scan — start a new scan (POST) or catch bad GETs
    [
      'pattern' => '_scan',
      'method'  => 'GET|POST',
      'action'  => function() {
        return option('scanner.proxy')();
      }
    ],
    // /_scan/{id}/lead — lead capture (POST)
    [
      'pattern' => '_scan/(:any)/lead',
      'method'  => 'GET|POST',
      'action'  => function($id) {
        return option('scanner.proxy')($id . '/lead');
      }
    ],
    // /_scan/{id} — fetch results (GET)
    [
      'pattern' => '_scan/(:any)',
      'method'  => 'GET|POST',
      'action'  => function($id) {
        return option('scanner.proxy')($id);
      }
    ],
    // /_lead — guide-form intake, validates then forwards to GHL
    [
      'pattern' => '_lead',
      'method'  => 'POST',
      'action'  => function() {
        return option('ghl.lead')();
      }
    ],
    // /sql-guide — serve the standalone SQL reference page
    [
      'pattern' => 'sql-guide',
      'action'  => function() {
        $file = kirby()->root('index') . '/assets/sql-reference.html';
        return is_file($file)
          ? new Kirby\Cms\Response(file_get_contents($file), 'text/html')
          : false;
      }
    ],
    // Legacy redirect: /projects -> /case-studies
    [
      'pattern' => 'projects',
      'action'  => function() {
        header('Location: ' . url('case-studies'), true, 301);
        exit;
      }
    ],
    [
      'pattern' => 'projects/(:all)',
      'action'  => function($path) {
        header('Location: ' . url('case-studies/' . $path), true, 301);
        exit;
      }
    ],
    // Case study slug renames
    [
      'pattern' => 'case-studies/n8n_taddy_api_nodes',
      'action'  => function() {
        header('Location: ' . url('case-studies/taddy-api-integrations'), true, 301);
        exit;
      }
    ],
    // Services index has no real content yet; send to the flagship service
    [
      'pattern' => 'services',
      'action'  => function() {
        header('Location: ' . url('services/sidecar'), true, 301);
        exit;
      }
    ],

    // QR redirects for printed collateral (Chamber bag drop cards).
    // 302 on purpose: destinations may change and scanners cache 301s.
    // Clicks append to site/logs/qr-clicks.log since server-side redirects
    // never reach GA4.
    [
      'pattern' => 'chamber',
      'action'  => function() {
        $log = kirby()->root('site') . '/logs/qr-clicks.log';
        @mkdir(dirname($log), 0755, true);
        @file_put_contents($log, date('c') . " chamber\n", FILE_APPEND);
        header('Location: https://calendly.com/logan-shimmerlabs/30-min-consult?utm_source=chamber-bag-drop&utm_medium=qr&utm_campaign=new-member-bag', true, 302);
        exit;
      }
    ],
    [
      'pattern' => 'skool',
      'action'  => function() {
        $log = kirby()->root('site') . '/logs/qr-clicks.log';
        @mkdir(dirname($log), 0755, true);
        @file_put_contents($log, date('c') . " skool\n", FILE_APPEND);
        header('Location: https://www.skool.com/main-street-ai-2900/about?utm_source=chamber-bag-drop&utm_medium=qr', true, 302);
        exit;
      }
    ],

    // SEO: Sitemap
    [
      'pattern' => 'sitemap.xml',
      'action'  => function() {
        $sitemap = [];
        $site = site();

        // Add homepage
        $sitemap[] = [
          'url' => $site->url(),
          'lastmod' => $site->modified('Y-m-d'),
          'priority' => '1.0',
          'changefreq' => 'weekly'
        ];

        // Add all listed pages (excluding error, offline, notes)
        $pages = $site->index()->listed()->not(['error', 'offline', 'notes']);

        // Also include specific unlisted pages we want indexed
        $extraPages = [
          'about',
          'contact',
          'case-studies',
          'comparison',
          'work',
          'stillwater-ai-consultant',
          'services/sidecar',
          'services/custom-apps',
          'services/api-integrations',
          'ai-agents-guide',
          'ai-security-business',
          'ai-security-education',
          'lunch-learn',
          'scan',
          'office-hours',
          'event-video',
        ];
        foreach ($extraPages as $slug) {
          if ($p = $site->find($slug)) {
            $pages = $pages->add($p);
          }
        }

        foreach ($pages as $page) {
          // Set priority based on page depth
          $priority = match($page->depth()) {
            1 => '0.8',
            2 => '0.6',
            default => '0.4'
          };

          $sitemap[] = [
            'url' => $page->url(),
            'lastmod' => $page->modified('Y-m-d'),
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
          $xml .= '    <lastmod>' . $item['lastmod'] . '</lastmod>' . PHP_EOL;
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

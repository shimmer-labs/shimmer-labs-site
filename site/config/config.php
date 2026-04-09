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

  // Routes
  'routes' => [
    // Proxy: POST /api/scan → scanner microservice
    [
      'pattern' => '_scan',
      'action'  => function() {
        $scannerUrl = option('scanner.api.url') . '/api/scan';
        $body = file_get_contents('php://input');

        $ch = curl_init($scannerUrl);
        curl_setopt_array($ch, [
          CURLOPT_POST           => true,
          CURLOPT_POSTFIELDS     => $body,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'X-Forwarded-For: ' . ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? ''),
          ],
          CURLOPT_TIMEOUT        => 60,
        ]);
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
      }
    ],
    // Proxy: /api/scan/{id}/lead → scanner microservice (lead capture)
    // Must come before the (:any) route so it matches first
    [
      'pattern' => '_scan/(:any)/lead',
      'action'  => function($id) {
        $scannerUrl = option('scanner.api.url') . '/api/scan/' . urlencode($id) . '/lead';
        $body = file_get_contents('php://input');

        $ch = curl_init($scannerUrl);
        curl_setopt_array($ch, [
          CURLOPT_POST           => true,
          CURLOPT_POSTFIELDS     => $body,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'X-Forwarded-For: ' . ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? ''),
          ],
          CURLOPT_TIMEOUT        => 30,
        ]);
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
      }
    ],
    // Proxy: /api/scan/{id} → scanner microservice (results)
    [
      'pattern' => '_scan/(:any)',
      'action'  => function($id) {
        $scannerUrl = option('scanner.api.url') . '/api/scan/' . urlencode($id);

        $ch = curl_init($scannerUrl);
        curl_setopt_array($ch, [
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT        => 30,
        ]);
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
          'lastmod' => $site->modified('c'),
          'priority' => '1.0',
          'changefreq' => 'weekly'
        ];

        // Add all listed pages (excluding error, offline, notes)
        $pages = $site->index()->listed()->not(['error', 'offline', 'notes']);

        // Also include specific unlisted pages we want indexed
        $extraPages = ['lunch-learn', 'scan'];
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

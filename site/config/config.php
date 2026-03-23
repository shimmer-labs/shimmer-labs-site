<?php

return [
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

  // SEO: Sitemap.xml Route
  'routes' => [
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

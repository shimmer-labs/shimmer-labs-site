<?php
/**
 * Schema.org Structured Data
 *
 * Emits JSON-LD per page type so AI shortlist tools and search engines
 * can read what's on the page in a structured way.
 */

$schema = [];

// ─────────────────────────────────────────────────────────────
// Global: Organization
// ─────────────────────────────────────────────────────────────
$schema[] = [
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  '@id' => $site->url() . '#organization',
  'name' => 'Shimmer Labs',
  'url' => $site->url(),
  'logo' => url('assets/images/shimmer-labs-logo.png'),
  'description' => 'AI consultant for small businesses in Oklahoma. Done-with-you AI Concierge, free AI office hours, and Sidecar automation builds. Based in Stillwater, Oklahoma.',
  'email' => 'logan@shimmerlabs.co',
  'telephone' => '+1-405-880-6674',
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => '901 S Main St, Suite 86',
    'addressLocality' => 'Stillwater',
    'addressRegion' => 'OK',
    'postalCode' => '74074',
    'addressCountry' => 'US'
  ],
  'sameAs' => [
    'https://www.linkedin.com/in/loganshimmer/',
    'https://github.com/shimmer-labs',
    'https://www.instagram.com/shimmer.labs/'
  ],
  'founder' => [
    '@type' => 'Person',
    '@id' => $site->url() . '#logan',
    'name' => 'Logan Shimmer',
    'jobTitle' => 'Founder & Systems Engineer'
  ]
];

// ─────────────────────────────────────────────────────────────
// Global: WebSite
// ─────────────────────────────────────────────────────────────
$schema[] = [
  '@context' => 'https://schema.org',
  '@type' => 'WebSite',
  'name' => 'Shimmer Labs',
  'url' => $site->url(),
  'publisher' => [
    '@id' => $site->url() . '#organization'
  ]
];

// ─────────────────────────────────────────────────────────────
// Homepage: ProfessionalService + Reviews for the portrait quad
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'home') {
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'ProfessionalService',
    '@id' => $site->url() . '#business',
    'name' => 'Shimmer Labs',
    'image' => url('assets/images/shimmer-labs-logo.png'),
    'description' => 'AI consulting for Oklahoma small businesses. AI Concierge (done-with-you, $750 to $2,250/mo by team size), Sidecar (AI-assisted workflows built for you, from $1,000 + from $250/mo), Custom Apps and API Integrations. Based in Stillwater, Oklahoma.',
    'url' => $site->url(),
    'email' => 'logan@shimmerlabs.co',
    'telephone' => '+1-405-880-6674',
    'address' => [
      '@type' => 'PostalAddress',
      'streetAddress' => '901 S Main St, Suite 86',
      'addressLocality' => 'Stillwater',
      'addressRegion' => 'OK',
      'postalCode' => '74074',
      'addressCountry' => 'US'
    ],
    'geo' => [
      '@type' => 'GeoCoordinates',
      'latitude' => 36.1084,
      'longitude' => -97.0584
    ],
    'areaServed' => [
      ['@type' => 'City', 'name' => 'Stillwater'],
      ['@type' => 'State', 'name' => 'Oklahoma'],
      ['@type' => 'Country', 'name' => 'United States']
    ],
    'priceRange' => '$250+',
    'founder' => [
      '@id' => $site->url() . '#logan'
    ],
    'hasOfferCatalog' => [
      '@type' => 'OfferCatalog',
      'name' => 'Services',
      'itemListElement' => [
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'Sidecar (AI-assisted operational workflows)',
            'description' => 'Narrow AI-assisted workflows that handle one job each, with a human in the loop on anything customer-facing. Live in a week, autonomous in a month.'
          ],
          'priceSpecification' => [
            '@type' => 'UnitPriceSpecification',
            'minPrice' => '250',
            'priceCurrency' => 'USD',
            'unitText' => 'MONTH',
            'referenceQuantity' => [
              '@type' => 'QuantitativeValue',
              'value' => 1,
              'unitCode' => 'MON'
            ]
          ]
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'Custom Apps (Web)',
            'description' => 'Web apps from wireframes to launched product. Flat-priced per scope.'
          ],
          'priceSpecification' => [
            '@type' => 'PriceSpecification',
            'minPrice' => '15000',
            'priceCurrency' => 'USD'
          ]
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'Custom Apps (iOS)',
            'description' => 'Native iOS apps in Swift. Flat-priced per scope.'
          ],
          'priceSpecification' => [
            '@type' => 'PriceSpecification',
            'minPrice' => '20000',
            'priceCurrency' => 'USD'
          ]
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'API Integrations',
            'description' => 'Point-to-point integrations for n8n, Zapier, and Make.com.'
          ],
          'priceSpecification' => [
            '@type' => 'PriceSpecification',
            'minPrice' => '2500',
            'maxPrice' => '7000',
            'priceCurrency' => 'USD'
          ]
        ]
      ]
    ]
  ];

}

// ─────────────────────────────────────────────────────────────
// About page: Person schema for Logan
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'about') {
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    '@id' => $site->url() . '#logan',
    'name' => 'Logan Shimmer',
    'givenName' => 'Logan',
    'familyName' => 'Shimmer',
    'jobTitle' => 'Founder & Systems Engineer',
    'description' => 'Systems engineer who builds AI-assisted operational workflows for small businesses. Two decades across National Instruments, Iterable, WeaveGrid, and Sense before founding Shimmer Labs.',
    'url' => $page->url(),
    'image' => $page->headshot()->isNotEmpty() && $page->image($page->headshot()) ? $page->image($page->headshot())->url() : null,
    'email' => 'logan@shimmerlabs.co',
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => 'Stillwater',
      'addressRegion' => 'OK',
      'addressCountry' => 'US'
    ],
    'worksFor' => [
      '@id' => $site->url() . '#organization'
    ],
    'alumniOf' => [
      '@type' => 'CollegeOrUniversity',
      'name' => 'Oklahoma State University',
      'url' => 'https://okstate.edu'
    ],
    'hasCredential' => [
      '@type' => 'EducationalOccupationalCredential',
      'name' => 'AI for Industry Microcredential',
      'credentialCategory' => 'Microcredential',
      'recognizedBy' => [
        '@type' => 'CollegeOrUniversity',
        'name' => 'Oklahoma State University CEAT Professional Development'
      ],
      'url' => 'https://ceat.catalog.instructure.com/browse/ai/courses/ai-literacy-and-application-for-technical-professionals'
    ],
    'sameAs' => [
      'https://www.linkedin.com/in/loganshimmer/',
      'https://github.com/shimmer-labs'
    ]
  ];
}

// ─────────────────────────────────────────────────────────────
// Service pages: Service schema with proper offers + areaServed
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'service') {
  $slug = $page->slug();

  $serviceSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $page->title()->value(),
    'description' => $page->summary()->or($page->meta_description())->excerpt(300)->value(),
    'url' => $page->url(),
    'provider' => [
      '@id' => $site->url() . '#organization'
    ],
    'areaServed' => [
      ['@type' => 'City', 'name' => 'Stillwater'],
      ['@type' => 'State', 'name' => 'Oklahoma'],
      ['@type' => 'Country', 'name' => 'United States']
    ],
    'serviceType' => 'Custom software development'
  ];

  if ($slug === 'sidecar') {
    $serviceSchema['offers'] = [
      '@type' => 'Offer',
      'priceSpecification' => [
        '@type' => 'UnitPriceSpecification',
        'minPrice' => '250',
        'priceCurrency' => 'USD',
        'unitText' => 'MONTH'
      ],
      'description' => 'Builds from $1,000 (half up front, half at go-live) + from $250/month to run. Model API costs pass-through. Cancel anytime, no contracts.'
    ];
  } elseif ($slug === 'concierge') {
    $serviceSchema['offers'] = [
      '@type' => 'Offer',
      'priceSpecification' => [
        '@type' => 'UnitPriceSpecification',
        'minPrice' => '750',
        'maxPrice' => '2250',
        'priceCurrency' => 'USD',
        'unitText' => 'MONTH'
      ],
      'description' => 'Done-with-you AI consulting priced by team size: Solo $750/month, Crew (2-10 people) $1,000/month, Shop (11-25) $1,500/month, Company (26-50) $2,250/month, 51+ custom. Founding offer: first 5 clients get one tier down, locked in. Two working sessions a month, direct text access, shared progress hub. Video or in person across Oklahoma.'
    ];
  } elseif ($slug === 'custom-apps') {
    $serviceSchema['offers'] = [
      [
        '@type' => 'Offer',
        'name' => 'Web App',
        'priceSpecification' => [
          '@type' => 'PriceSpecification',
          'minPrice' => '15000',
          'priceCurrency' => 'USD'
        ]
      ],
      [
        '@type' => 'Offer',
        'name' => 'iOS App',
        'priceSpecification' => [
          '@type' => 'PriceSpecification',
          'minPrice' => '20000',
          'priceCurrency' => 'USD'
        ]
      ]
    ];
  } elseif ($slug === 'api-integrations') {
    $serviceSchema['offers'] = [
      '@type' => 'Offer',
      'priceSpecification' => [
        '@type' => 'PriceSpecification',
        'minPrice' => '2500',
        'maxPrice' => '7000',
        'priceCurrency' => 'USD'
      ]
    ];
  }

  $schema[] = $serviceSchema;

  // FAQPage schema on any service page with FAQ content
  if ($page->faq()->isNotEmpty()) {
    $faqItems = [];
    foreach ($page->faq()->toStructure() as $item) {
      $faqItems[] = [
        '@type' => 'Question',
        'name' => $item->question()->value(),
        'acceptedAnswer' => [
          '@type' => 'Answer',
          'text' => $item->answer()->value()
        ]
      ];
    }
    if (!empty($faqItems)) {
      $schema[] = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqItems
      ];
    }
  }
}

// ─────────────────────────────────────────────────────────────
// Project pages (TreeBidPro, FlowMint, EventSnag, Paidly when project-template)
// SoftwareApplication schema
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'project') {
  $appSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => $page->title()->value(),
    'applicationCategory' => 'BusinessApplication',
    'description' => $page->summary()->excerpt(300)->value(),
    'operatingSystem' => $page->tech_stack()->contains('iOS') || $page->tech_stack()->contains('Swift') ? 'iOS' : 'Web',
    'creator' => [
      '@id' => $site->url() . '#organization'
    ],
    'offers' => [
      '@type' => 'Offer',
      'price' => '0',
      'priceCurrency' => 'USD',
      'availability' => 'https://schema.org/InStock'
    ]
  ];
  $schema[] = $appSchema;
}

// ─────────────────────────────────────────────────────────────
// Case study pages: Article + Review (for client testimonial)
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'case-study') {
  $articleSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $page->title()->value() . ' Case Study',
    'articleSection' => 'Case Study',
    'description' => $page->summary()->or($page->meta_description())->excerpt(300)->value(),
    'url' => $page->url(),
    'datePublished' => $page->modified('c'),
    'dateModified' => $page->modified('c'),
    'author' => [
      '@id' => $site->url() . '#organization'
    ],
    'publisher' => [
      '@id' => $site->url() . '#organization'
    ],
    'mainEntityOfPage' => [
      '@type' => 'WebPage',
      '@id' => $page->url()
    ]
  ];
  if ($page->hero_image()->isNotEmpty() && $page->hero_image()->toFile()) {
    $articleSchema['image'] = $page->hero_image()->toFile()->url();
  }
  if ($page->client_name()->isNotEmpty()) {
    $articleSchema['about'] = [
      '@type' => 'LocalBusiness',
      'name' => $page->client_name()->value()
    ];
    if ($page->client_location()->isNotEmpty()) {
      $articleSchema['about']['address'] = $page->client_location()->value();
    }
  }
  $schema[] = $articleSchema;

}

// ─────────────────────────────────────────────────────────────
// Stillwater AI consultant landing page: LocalBusiness schema
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'stillwater-ai-consultant') {
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    '@id' => $site->url() . '#stillwater-local',
    'name' => 'Shimmer Labs — AI Consultant in Stillwater, OK',
    'description' => 'Local AI consultant and software shop serving Stillwater and north-central Oklahoma small businesses. AI-assisted workflows, custom web and iOS apps, API integrations. Free Office Hours every Tuesday and Thursday at WorkIT.',
    'url' => $page->url(),
    'telephone' => '+1-405-880-6674',
    'email' => 'logan@shimmerlabs.co',
    'image' => url('assets/images/shimmer-labs-logo.png'),
    'address' => [
      '@type' => 'PostalAddress',
      'streetAddress' => '901 S Main St, Suite 86',
      'addressLocality' => 'Stillwater',
      'addressRegion' => 'OK',
      'postalCode' => '74074',
      'addressCountry' => 'US'
    ],
    'geo' => [
      '@type' => 'GeoCoordinates',
      'latitude' => 36.1122,
      'longitude' => -97.0583
    ],
    'areaServed' => [
      ['@type' => 'City', 'name' => 'Stillwater'],
      ['@type' => 'AdministrativeArea', 'name' => 'Payne County'],
      ['@type' => 'State', 'name' => 'Oklahoma']
    ],
    'openingHoursSpecification' => [
      [
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Tuesday', 'Thursday'],
        'opens' => '14:00',
        'closes' => '16:00',
        'name' => 'AI Office Hours (walk-in)'
      ]
    ],
    'founder' => [
      '@id' => $site->url() . '#logan'
    ],
    'parentOrganization' => [
      '@id' => $site->url() . '#organization'
    ],
    'priceRange' => '$250+',
    'sameAs' => [
      'https://www.linkedin.com/in/loganshimmer/',
      'https://github.com/shimmer-labs',
      'https://www.instagram.com/shimmer.labs/',
      'https://www.stillwaterchamber.org/membership/business-directory'
    ]
  ];
}

// ─────────────────────────────────────────────────────────────
// Free-guide landing pages: Article schema
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'landing') {
  $landingSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $page->hero_title()->or($page->title())->value(),
    'description' => $page->hero_description()->or($page->meta_description())->excerpt(300)->value(),
    'url' => $page->url(),
    'datePublished' => $page->modified('c'),
    'dateModified' => $page->modified('c'),
    'author' => [
      '@id' => $site->url() . '#logan'
    ],
    'publisher' => [
      '@id' => $site->url() . '#organization'
    ],
    'mainEntityOfPage' => [
      '@type' => 'WebPage',
      '@id' => $page->url()
    ],
    'about' => [
      '@type' => 'Thing',
      'name' => 'Artificial Intelligence for small business'
    ]
  ];
  $schema[] = $landingSchema;
}

// ─────────────────────────────────────────────────────────────
// Trade pages + articles: Article schema
// ─────────────────────────────────────────────────────────────
if (in_array($page->intendedTemplate()->name(), ['trade', 'article'])) {
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $page->hero_title()->or($page->title())->value(),
    'description' => $page->meta_description()->or($page->intro())->excerpt(300)->value(),
    'url' => $page->url(),
    'datePublished' => $page->modified('c'),
    'dateModified' => $page->modified('c'),
    'author' => [
      '@id' => $site->url() . '#logan'
    ],
    'publisher' => [
      '@id' => $site->url() . '#organization'
    ],
    'mainEntityOfPage' => [
      '@type' => 'WebPage',
      '@id' => $page->url()
    ]
  ];
}

// ─────────────────────────────────────────────────────────────
// FAQPage schema wherever structured FAQ content exists
// (trade pages, guide landings, articles)
// ─────────────────────────────────────────────────────────────
if (in_array($page->intendedTemplate()->name(), ['trade', 'landing', 'article']) && $page->faq()->isNotEmpty()) {
  $faqItems = [];
  foreach ($page->faq()->toStructure() as $item) {
    $faqItems[] = [
      '@type' => 'Question',
      'name' => $item->question()->value(),
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => $item->answer()->value()
      ]
    ];
  }
  if (!empty($faqItems)) {
    $schema[] = [
      '@context' => 'https://schema.org',
      '@type' => 'FAQPage',
      'mainEntity' => $faqItems
    ];
  }
}

// ─────────────────────────────────────────────────────────────
// Free AI Office Hours: recurring Event
// ─────────────────────────────────────────────────────────────
if ($page->intendedTemplate()->name() === 'office-hours') {
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'Event',
    'name' => 'Free AI Office Hours in Stillwater, OK',
    'description' => 'Free, walk-in help with AI and automation for small business owners. Every Tuesday and Thursday, 2 to 4 PM, at WorkIT Coworking in Stillwater, Oklahoma. No RSVP, no pitch.',
    'url' => $page->url(),
    'image' => url('assets/images/office.jpg'),
    'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
    'eventStatus' => 'https://schema.org/EventScheduled',
    'isAccessibleForFree' => true,
    'startDate' => '2026-01-06T14:00:00-06:00',
    'eventSchedule' => [
      '@type' => 'Schedule',
      'byDay' => ['https://schema.org/Tuesday', 'https://schema.org/Thursday'],
      'startTime' => '14:00',
      'endTime' => '16:00',
      'repeatFrequency' => 'P1W',
      'scheduleTimezone' => 'America/Chicago',
    ],
    'location' => [
      '@type' => 'Place',
      'name' => 'WorkIT Coworking Center',
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '901 S Main St',
        'addressLocality' => 'Stillwater',
        'addressRegion' => 'OK',
        'postalCode' => '74074',
        'addressCountry' => 'US',
      ],
    ],
    'offers' => [
      '@type' => 'Offer',
      'price' => '0',
      'priceCurrency' => 'USD',
      'availability' => 'https://schema.org/InStock',
      'url' => $page->url(),
    ],
    'organizer' => ['@id' => $site->url() . '#organization'],
    'performer' => ['@id' => $site->url() . '#logan'],
  ];
}

// ─────────────────────────────────────────────────────────────
// BreadcrumbList for every non-home page (Home > Section > Page)
// ─────────────────────────────────────────────────────────────
if (!$page->isHomePage()) {
  $crumbs = [['name' => 'Home', 'item' => $site->url()]];
  foreach ($page->parents()->flip() as $ancestor) {
    $crumbs[] = ['name' => $ancestor->title()->value(), 'item' => $ancestor->url()];
  }
  $crumbs[] = ['name' => $page->title()->value(), 'item' => $page->url()];
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => array_map(fn($c, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'item' => $c['item']], $crumbs, array_keys($crumbs)),
  ];
}

// ─────────────────────────────────────────────────────────────
// VideoObject for pages that embed or host a video. Google only counts a
// video as indexed when the page carries this. Durations and upload dates
// for hosted embeds are pinned here (Vimeo/YouTube oEmbed, Sep 10 2026).
// ─────────────────────────────────────────────────────────────
$videoMeta = [
  'vimeo:1188212057' => ['name' => 'Anna Moore, Sweat Yoga & Fitness, on the membership sidecar', 'duration' => 'PT59S', 'uploadDate' => '2026-04-30T15:31:10-05:00',
    'thumbnail' => 'https://i.vimeocdn.com/video/2152417916-ea257fcdbad3261cb565a1e44d14859d1ac7e6bb007a47fff0d7dc1561fb5803-d_1280x720'],
  'youtube:31U-SAh8NLM' => ['name' => 'Sample event recap video: ASC Conference intro', 'duration' => 'PT3M51S', 'uploadDate' => '2026-04-14T13:24:10-07:00',
    'thumbnail' => 'https://i.ytimg.com/vi/31U-SAh8NLM/hqdefault.jpg'],
];
$videos = [];
$tpl = $page->intendedTemplate()->name();
$videoUrl = $page->video_url()->isNotEmpty() ? $page->video_url()->value() : ($tpl === 'event-video' ? 'https://www.youtube.com/embed/31U-SAh8NLM?rel=0' : '');
if ($videoUrl !== '') {
  $key = null;
  if (preg_match('~vimeo\.com/video/(\d+)~', $videoUrl, $m)) { $key = 'vimeo:' . $m[1]; $embed = 'https://player.vimeo.com/video/' . $m[1]; }
  elseif (preg_match('~youtube\.com/embed/([\w-]+)~', $videoUrl, $m)) { $key = 'youtube:' . $m[1]; $embed = 'https://www.youtube.com/embed/' . $m[1]; }
  if ($key && isset($videoMeta[$key])) {
    $vm = $videoMeta[$key];
    $videos[] = [
      '@context' => 'https://schema.org',
      '@type' => 'VideoObject',
      'name' => $vm['name'],
      'description' => $page->summary()->or($page->meta_description())->excerpt(300)->value(),
      'thumbnailUrl' => [$vm['thumbnail']],
      'uploadDate' => $vm['uploadDate'],
      'duration' => $vm['duration'],
      'embedUrl' => $embed,
      'publisher' => ['@id' => $site->url() . '#organization'],
    ];
  }
}
if ($page->demo_video()->isNotEmpty() && ($vf = $page->demo_video()->toFile())) {
  $thumb = $page->images()->findBy('name', 'eventsnag-home-screen') ?? $page->images()->first();
  $videos[] = [
    '@context' => 'https://schema.org',
    '@type' => 'VideoObject',
    'name' => $page->title()->value() . ' demo',
    'description' => $page->summary()->or($page->meta_description())->excerpt(300)->value(),
    'thumbnailUrl' => $thumb ? [$thumb->url()] : [],
    'uploadDate' => date('c', $vf->modified()),
    'duration' => 'PT32S',
    'contentUrl' => $vf->url(),
    'publisher' => ['@id' => $site->url() . '#organization'],
  ];
}
foreach ($videos as $v) { $schema[] = $v; }

// ─────────────────────────────────────────────────────────────
// Emit
// ─────────────────────────────────────────────────────────────
foreach ($schema as $item):
?>
<script type="application/ld+json">
<?= json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
</script>
<?php endforeach ?>

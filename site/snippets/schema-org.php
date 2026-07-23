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
  'description' => 'Custom software for small businesses. AI-assisted operational workflows, web and iOS apps, and API integrations. Based in Stillwater, Oklahoma.',
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
    'description' => 'Custom software for small businesses. Sidecar (AI-assisted operational workflows from $1,000/mo), Custom Apps (web from $15k, iOS from $20k), API Integrations ($2,500-$7,000). Based in Stillwater, Oklahoma.',
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
    'priceRange' => '$1,000+',
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
            'price' => '1000',
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

  // Reviews for the portrait quad — Sarah, Anna, Danny, Kristen
  $portraits = [
    [
      'author' => 'Sarah Gold',
      'role' => 'Marketing Program Manager, Supabase',
      'body' => '5x output. 100+ creators shipped in months. 15 hours a week back. Sarah went from YouTube detective to leading creative campaigns.'
    ],
    [
      'author' => 'Anna Moore',
      'role' => 'Owner, Sweat Yoga & Fitness',
      'body' => 'I hated this place. I was actively looking for someone to buy it. MVP live in week one, fully autonomous by week four. 50+ cancellations and freezes handled to date, including the graduation rush.'
    ],
    [
      'author' => 'Danny Mathews',
      'role' => 'Founder, Taddy',
      'body' => 'Logan built comprehensive integrations for the Taddy Podcast API across n8n, Zapier, and Make.com. Clean code, thorough documentation, and he responded quickly to any support needed.'
    ],
    [
      'author' => 'Kristen Hadley',
      'role' => 'Founder, TreeBidPro',
      'body' => 'From wireframes I had been sitting on for over a year to a fully production-ready web app in just two weeks. The pricing-rule engine with LLM-assisted bid generation works flawlessly.'
    ]
  ];
  foreach ($portraits as $p) {
    $schema[] = [
      '@context' => 'https://schema.org',
      '@type' => 'Review',
      'itemReviewed' => [
        '@id' => $site->url() . '#business'
      ],
      'author' => [
        '@type' => 'Person',
        'name' => $p['author'],
        'jobTitle' => $p['role']
      ],
      'reviewBody' => $p['body'],
      'reviewRating' => [
        '@type' => 'Rating',
        'ratingValue' => '5',
        'bestRating' => '5'
      ]
    ];
  }
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
        'price' => '1000',
        'priceCurrency' => 'USD',
        'unitText' => 'MONTH'
      ],
      'description' => '$2,000 setup + $1,000/month to run. Model API costs pass-through. Cancel anytime, no contracts.'
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

  // FAQPage schema on the Sidecar page only
  if ($slug === 'sidecar' && $page->faq()->isNotEmpty()) {
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

  // Embedded Review schema if there's a client hero quote
  if ($page->hero_quote()->isNotEmpty() && $page->client_role()->isNotEmpty()) {
    $schema[] = [
      '@context' => 'https://schema.org',
      '@type' => 'Review',
      'itemReviewed' => [
        '@id' => $site->url() . '#business'
      ],
      'author' => [
        '@type' => 'Person',
        'name' => $page->client_role()->value()
      ],
      'reviewBody' => $page->hero_quote()->value(),
      'reviewRating' => [
        '@type' => 'Rating',
        'ratingValue' => '5',
        'bestRating' => '5'
      ]
    ];
  }
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
    'priceRange' => '$1,000+',
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
// Emit
// ─────────────────────────────────────────────────────────────
foreach ($schema as $item):
?>
<script type="application/ld+json">
<?= json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
</script>
<?php endforeach ?>

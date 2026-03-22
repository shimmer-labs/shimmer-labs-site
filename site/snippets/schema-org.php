<?php
/**
 * Schema.org Structured Data
 *
 * Outputs JSON-LD structured data for SEO
 */

$schema = [];

// Organization Schema (Global)
$schema[] = [
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  'name' => 'Shimmer Labs',
  'url' => $site->url(),
  'logo' => url('assets/images/shimmer-labs-logo.png'),
  'description' => 'AI agents for service businesses and custom software development. Sidecar automates hiring, social media, and prospecting. Web apps, iOS apps, and API integrations. Based in Stillwater, OK.',
  'email' => 'logan@shimmerlabs.co',
  'sameAs' => [
    'https://www.linkedin.com/in/loganshimmer/',
    'https://github.com/shimmer-labs'
  ],
  'founder' => [
    '@type' => 'Person',
    'name' => 'Logan Shimmer',
    'jobTitle' => 'Founder & Developer'
  ]
];

// Website Schema
$schema[] = [
  '@context' => 'https://schema.org',
  '@type' => 'WebSite',
  'name' => 'Shimmer Labs',
  'url' => $site->url(),
  'potentialAction' => [
    '@type' => 'SearchAction',
    'target' => $site->url() . '?q={search_term_string}',
    'query-input' => 'required name=search_term_string'
  ]
];

// Page-specific schemas
if ($page->intendedTemplate() == 'home') {
  // ProfessionalService Schema for homepage
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'ProfessionalService',
    '@id' => $site->url() . '#business',
    'name' => 'Shimmer Labs',
    'image' => url('assets/images/shimmer-labs-logo.png'),
    'description' => 'AI agents for service businesses and custom software development. Sidecar automates admin tasks 24/7. Web apps, iOS apps, and API integrations. Stillwater, OK.',
    'url' => $site->url(),
    'email' => 'logan@shimmerlabs.co',
    'address' => [
      '@type' => 'PostalAddress',
      'streetAddress' => '901 S. Main St',
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
      ['@type' => 'State', 'name' => 'Oklahoma']
    ],
    'priceRange' => '$$$',
    'founder' => [
      '@type' => 'Person',
      'name' => 'Logan Shimmer',
      'jobTitle' => 'Founder & Developer'
    ],
    'hasOfferCatalog' => [
      '@type' => 'OfferCatalog',
      'name' => 'Services',
      'itemListElement' => [
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'Sidecar — AI Agents',
            'description' => 'AI agents that handle hiring, social media, prospecting, and proposals for service businesses. 24/7 automation.'
          ]
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'Custom Apps',
            'description' => 'Web apps and iOS apps from wireframes to launched product',
            'priceSpecification' => [
              '@type' => 'PriceSpecification',
              'price' => '25000-75000',
              'priceCurrency' => 'USD'
            ]
          ]
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'API Integrations',
            'description' => 'Custom API integrations and backend development',
            'priceSpecification' => [
              '@type' => 'PriceSpecification',
              'price' => '3500-12000',
              'priceCurrency' => 'USD'
            ]
          ]
        ]
      ]
    ]
  ];
}

if ($page->intendedTemplate() == 'services' || $page->parent()?->intendedTemplate() == 'services') {
  // Service Schema
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $page->title(),
    'provider' => [
      '@type' => 'Organization',
      'name' => 'Shimmer Labs',
      'url' => $site->url()
    ],
    'description' => $page->summary()->or($page->intro())->excerpt(200),
    'serviceType' => 'Software Development'
  ];
}

if ($page->intendedTemplate() == 'project') {
  // SoftwareApplication Schema for projects
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => $page->title(),
    'applicationCategory' => 'BusinessApplication',
    'description' => $page->summary(),
    'operatingSystem' => $page->tech_stack()->contains('iOS') ? 'iOS' : 'Web',
    'offers' => [
      '@type' => 'Offer',
      'price' => '0',
      'priceCurrency' => 'USD'
    ],
    'creator' => [
      '@type' => 'Organization',
      'name' => 'Shimmer Labs'
    ]
  ];
}

// Output JSON-LD
foreach ($schema as $item):
?>
<script type="application/ld+json">
<?= json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
</script>
<?php endforeach ?>

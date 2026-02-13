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
  'description' => 'Custom software development for small businesses. Web apps, mobile apps, Shopify apps, and API integrations. Based in Stillwater, OK.',
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
    'description' => 'Custom software for small businesses. Mobile apps, web apps, Shopify development, and API integrations. Stillwater, OK.',
    'url' => $site->url(),
    'email' => 'logan@shimmerlabs.co',
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => 'Stillwater',
      'addressRegion' => 'OK',
      'addressCountry' => 'US'
    ],
    'priceRange' => '$$$',
    'founder' => [
      '@type' => 'Person',
      'name' => 'Logan Shimmer',
      'jobTitle' => 'Founder & Developer'
    ],
    'hasOfferCatalog' => [
      '@type' => 'OfferCatalog',
      'name' => 'Development Services',
      'itemListElement' => [
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
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'Wireframe to Web App',
            'description' => 'Figma/Subframe to production Next.js app',
            'priceSpecification' => [
              '@type' => 'PriceSpecification',
              'price' => '18500-55000',
              'priceCurrency' => 'USD'
            ]
          ]
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'Full-Stack SaaS Development',
            'description' => '0→1 SaaS product development with Next.js and Supabase',
            'priceSpecification' => [
              '@type' => 'PriceSpecification',
              'price' => '45000-125000',
              'priceCurrency' => 'USD'
            ]
          ]
        ],
        [
          '@type' => 'Offer',
          'itemOffered' => [
            '@type' => 'Service',
            'name' => 'iOS App Development',
            'description' => 'Native iOS development in Swift',
            'priceSpecification' => [
              '@type' => 'PriceSpecification',
              'price' => '35000-75000',
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

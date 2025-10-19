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
  'description' => 'Business automation and custom integration solutions for small businesses. We help you automate workflows, build API wrappers, and create n8n automations.',
  'email' => 'logan@shimmerlabs.co',
  'sameAs' => [
    'https://www.linkedin.com/in/loganshimmer/',
    'https://github.com/shimmer-labs'
  ],
  'founder' => [
    '@type' => 'Person',
    'name' => 'Logan Shimmer',
    'jobTitle' => 'Founder & Automation Architect'
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
  // LocalBusiness Schema for homepage
  $schema[] = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    '@id' => $site->url() . '#localbusiness',
    'name' => 'Shimmer Labs',
    'image' => url('assets/images/shimmer-labs-logo.png'),
    'description' => 'Automate your business, reclaim your time. Custom automation solutions for small businesses.',
    'url' => $site->url(),
    'telephone' => '',
    'email' => 'logan@shimmerlabs.co',
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => 'Stillwater',
      'addressRegion' => 'OK',
      'addressCountry' => 'US'
    ],
    'priceRange' => '$$',
    'openingHoursSpecification' => [
      '@type' => 'OpeningHoursSpecification',
      'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      'opens' => '09:00',
      'closes' => '17:00'
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
    'serviceType' => 'Business Automation'
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

<?php

return [
  'url' => $_SERVER['SERVER_NAME'] === 'localhost'
    ? 'http://localhost:8000'
    : 'https://shimmerlabs.co',

  // Analytics Configuration
  // Choose one or both (Plausible recommended for privacy-first approach)

  // Plausible Analytics (Privacy-friendly, no cookies, GDPR compliant)
  'analytics.plausible.enabled' => true,
  'analytics.plausible.domain' => 'shimmerlabs.co',

  // Google Analytics 4 (GA4) - Uncomment to enable
  // 'analytics.ga4.enabled' => true,
  // 'analytics.ga4.measurementId' => 'G-XXXXXXXXXX', // Replace with your Measurement ID
];
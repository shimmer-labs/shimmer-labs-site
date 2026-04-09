// Scanner form handler (homepage)
// Use helper that runs immediately if DOM is already ready (fixes Firefox iOS
// where DOMContentLoaded fires before bottom-of-body scripts parse)
function onReady(fn) {
  if (document.readyState !== 'loading') { fn(); }
  else { document.addEventListener('DOMContentLoaded', fn); }
}
onReady(function() {
  var scannerForm = document.getElementById('scannerForm');
  if (!scannerForm) return;

  // Localhost: talk to scanner directly. Prod: same-origin proxy at /_scan
  // (avoids Firefox Enhanced Tracking Protection blocking cross-origin fetch)
  var isLocal = window.location.hostname === 'localhost';
  var SCANNER_API = isLocal ? 'http://localhost:3001' : '';
  var SCAN_PATH = isLocal ? '/api/scan' : '/_scan';

  var SCAN_TIMEOUT_MS = 45000; // 45 second timeout

  var loadingSteps = [
    { at: 0, text: 'Reading your website...', progress: 15 },
    { at: 4000, text: 'Identifying opportunities...', progress: 45 },
    { at: 8000, text: 'Writing job descriptions...', progress: 75 },
    { at: 12000, text: 'Almost done — this one\'s a meaty site.', progress: 88 },
  ];

  function showError(msg) {
    var errorEl = document.getElementById('scannerError');
    var loadingEl = document.getElementById('scannerLoading');
    var progressFill = document.getElementById('scannerProgressFill');
    scannerForm.style.display = '';
    loadingEl.style.display = 'none';
    progressFill.style.width = '0%';
    errorEl.textContent = msg;
    errorEl.style.display = 'block';
  }

  scannerForm.addEventListener('submit', function(e) {
    e.preventDefault();

    var urlInput = document.getElementById('scannerUrl');
    var loadingEl = document.getElementById('scannerLoading');
    var errorEl = document.getElementById('scannerError');
    var loadingTextEl = document.getElementById('scannerLoadingText');
    var progressFill = document.getElementById('scannerProgressFill');

    var url = urlInput.value.trim();
    if (!url) return;

    // Normalize URL
    if (url.indexOf('http://') !== 0 && url.indexOf('https://') !== 0) {
      url = 'https://' + url;
    }

    // Show loading, hide form + error
    scannerForm.style.display = 'none';
    loadingEl.style.display = 'flex';
    errorEl.style.display = 'none';

    // Linear loading steps
    loadingTextEl.textContent = loadingSteps[0].text;
    progressFill.style.width = loadingSteps[0].progress + '%';

    var stepTimeouts = [];
    for (var i = 1; i < loadingSteps.length; i++) {
      (function(step) {
        stepTimeouts.push(setTimeout(function() {
          loadingTextEl.textContent = step.text;
          progressFill.style.width = step.progress + '%';
        }, step.at));
      })(loadingSteps[i]);
    }

    // Timeout fallback — if scan takes too long, show error
    var timeoutId = setTimeout(function() {
      if (aborted) return;
      aborted = true;
      if (controller) controller.abort();
      stepTimeouts.forEach(clearTimeout);
      showError('Scan timed out. The site may be too large or temporarily unreachable. Please try again.');
    }, SCAN_TIMEOUT_MS);

    var aborted = false;
    var controller = null;

    // GA4 event
    if (typeof gtag === 'function') {
      gtag('event', 'scan_started', { scan_url: url });
    }

    // Use AbortController if available (all modern browsers)
    if (typeof AbortController !== 'undefined') {
      controller = new AbortController();
    }

    var fetchOptions = {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ url: url })
    };
    if (controller) {
      fetchOptions.signal = controller.signal;
    }

    fetch(SCANNER_API + SCAN_PATH, fetchOptions)
      .then(function(response) {
        return response.json().then(function(data) {
          if (!response.ok) {
            throw new Error(data.error || 'Scan failed. Please try again.');
          }
          return data;
        });
      })
      .then(function(data) {
        if (aborted) return;
        clearTimeout(timeoutId);
        stepTimeouts.forEach(clearTimeout);
        progressFill.style.width = '100%';
        window.location.href = '/scan?id=' + data.scanId;
      })
      .catch(function(err) {
        if (aborted) return;
        aborted = true;
        clearTimeout(timeoutId);
        stepTimeouts.forEach(clearTimeout);
        var msg = err.message || 'Something went wrong. Please try again.';
        // Friendlier message for network/CORS errors
        if (msg === 'Failed to fetch' || msg.indexOf('NetworkError') !== -1 || msg.indexOf('CORS') !== -1) {
          msg = 'Could not reach the scanner. Check your connection and try again.';
        }
        showError(msg);
      });
  });
});

// Lazy Load Images
onReady(() => {
  const images = document.querySelectorAll('img[data-src]');

  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.classList.add('loaded');
          observer.unobserve(img);
        }
      });
    });

    images.forEach(img => imageObserver.observe(img));
  } else {
    // Fallback for older browsers
    images.forEach(img => {
      img.src = img.dataset.src;
      img.classList.add('loaded');
    });
  }
});

// Fade in content on scroll
onReady(() => {
  const fadeElements = document.querySelectorAll('.fade-in-on-scroll');

  if ('IntersectionObserver' in window) {
    const fadeObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('fade-in');
          fadeObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    fadeElements.forEach(el => fadeObserver.observe(el));
  }
});

// Menu overlay functionality
onReady(() => {
  const menuToggle = document.querySelector('.menu-toggle');
  const menuOverlay = document.getElementById('menuOverlay');
  const menuClose = document.querySelector('.menu-close');

  if (!menuToggle || !menuOverlay || !menuClose) return;

  // Close menu function
  const closeMenu = () => {
    menuOverlay.classList.remove('active');
    setTimeout(() => {
      menuOverlay.style.display = 'none';
    }, 300);
    document.body.style.overflow = '';
  };

  // Open menu
  menuToggle.addEventListener('click', () => {
    menuOverlay.style.display = 'flex';
    setTimeout(() => {
      menuOverlay.classList.add('active');
    }, 10);
    document.body.style.overflow = 'hidden';
  });

  // Close on button click
  menuClose.addEventListener('click', closeMenu);

  // Close menu when clicking any link inside
  const menuLinks = menuOverlay.querySelectorAll('a');
  menuLinks.forEach(link => {
    link.addEventListener('click', closeMenu);
  });

  // Close on overlay background click
  menuOverlay.addEventListener('click', (e) => {
    if (e.target === menuOverlay) {
      closeMenu();
    }
  });

  // Close on ESC key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && menuOverlay.classList.contains('active')) {
      closeMenu();
    }
  });
});

// Contact form AJAX submission
onReady(() => {
  const contactForm = document.getElementById('contactForm');
  
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      
      const formData = new FormData(contactForm);
      const button = contactForm.querySelector('button[type="submit"]');
      const originalText = button.textContent;
      
      button.textContent = 'Sending...';
      button.disabled = true;
      
      try {
        const response = await fetch(contactForm.action, {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json'
          }
        });
        
        if (response.ok) {
          window.location.href = '/contact?success';
        } else {
          throw new Error('Form submission failed');
        }
      } catch (error) {
        alert('Oops! There was a problem submitting your form. Please try again.');
        button.textContent = originalText;
        button.disabled = false;
      }
    });
  }
});

// Image lightbox
onReady(() => {
  const galleryItems = document.querySelectorAll('.gallery-item:not(.gallery-item--video)');
  const lightbox = document.getElementById('lightbox');
  const lightboxImage = document.querySelector('.lightbox-image');
  const lightboxClose = document.querySelector('.lightbox-close');

  if (galleryItems.length > 0 && lightbox) {
    galleryItems.forEach(item => {
      item.addEventListener('click', () => {
        const imgSrc = item.dataset.src || item.querySelector('img').src;
        lightboxImage.src = imgSrc;
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
      });
    });

    lightboxClose?.addEventListener('click', () => {
      lightbox.style.display = 'none';
      document.body.style.overflow = '';
    });

    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) {
        lightbox.style.display = 'none';
        document.body.style.overflow = '';
      }
    });
  }
});

// Gallery thumbnail switcher and zoom
onReady(() => {
  const thumbnails = document.querySelectorAll('.thumbnail');
  const galleryFeatured = document.getElementById('galleryFeatured');
  const lightbox = document.getElementById('lightbox');
  const lightboxImage = document.querySelector('.lightbox-image');
  const lightboxClose = document.querySelector('.lightbox-close');

  if (thumbnails.length > 0 && galleryFeatured) {
    thumbnails.forEach(thumbnail => {
      thumbnail.addEventListener('click', () => {
        thumbnails.forEach(t => t.classList.remove('thumbnail--active'));
        thumbnail.classList.add('thumbnail--active');

        const type = thumbnail.dataset.type;
        const src = thumbnail.dataset.src;
        const videoType = thumbnail.dataset.videoType;

        galleryFeatured.innerHTML = '';

        if (type === 'video') {
          if (videoType === 'local') {
            // Local video file (MP4, WebM, etc.)
            const video = document.createElement('video');
            video.id = 'featuredVideo';
            video.controls = true;
            video.autoplay = true;
            video.muted = true;
            video.loop = true;
            video.playsInline = true;
            video.style.width = '100%';
            video.style.height = 'auto';
            video.style.display = 'block';

            const source = document.createElement('source');
            source.src = src;
            // Determine video type from file extension
            const extension = src.split('.').pop().toLowerCase();
            source.type = 'video/' + extension;

            video.appendChild(source);
            galleryFeatured.appendChild(video);
          } else {
            // YouTube embed
            const iframe = document.createElement('iframe');
            iframe.id = 'featuredVideo';
            iframe.src = src;
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');
            galleryFeatured.appendChild(iframe);
          }
        } else {
          const img = document.createElement('img');
          img.src = src;
          img.className = 'zoomable';
          img.style.cursor = 'zoom-in';
          
          // Add zoom hint
          const zoomHint = document.createElement('div');
          zoomHint.className = 'zoom-hint';
          zoomHint.textContent = '🔍 Click to enlarge';
          
          galleryFeatured.appendChild(img);
          galleryFeatured.appendChild(zoomHint);
          
          // Add click to zoom
          img.addEventListener('click', () => {
            lightboxImage.src = src;
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden';
          });
        }
      });
    });
  }

  // Close lightbox
  if (lightboxClose && lightbox) {
    lightboxClose.addEventListener('click', () => {
      lightbox.style.display = 'none';
      document.body.style.overflow = '';
    });

    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) {
        lightbox.style.display = 'none';
        document.body.style.overflow = '';
      }
    });

    // ESC key to close
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && lightbox.style.display === 'flex') {
        lightbox.style.display = 'none';
        document.body.style.overflow = '';
      }
    });
  }
});
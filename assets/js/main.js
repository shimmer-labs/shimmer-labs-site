// Scanner form handler (homepage)
document.addEventListener('DOMContentLoaded', () => {
  const scannerForm = document.getElementById('scannerForm');
  if (!scannerForm) return;

  const SCANNER_API = window.location.hostname === 'localhost'
    ? 'http://localhost:3001'
    : 'https://scanner.shimmerlabs.co';

  const loadingSteps = [
    { at: 0, text: 'Reading your website...', progress: 15 },
    { at: 4000, text: 'Identifying opportunities...', progress: 45 },
    { at: 8000, text: 'Writing job descriptions...', progress: 75 },
    { at: 12000, text: 'Almost done — this one\'s a meaty site.', progress: 88 },
  ];

  scannerForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const urlInput = document.getElementById('scannerUrl');
    const loadingEl = document.getElementById('scannerLoading');
    const errorEl = document.getElementById('scannerError');
    const loadingTextEl = document.getElementById('scannerLoadingText');
    const progressFill = document.getElementById('scannerProgressFill');

    let url = urlInput.value.trim();
    if (!url) return;

    // Normalize URL
    if (!url.startsWith('http://') && !url.startsWith('https://')) {
      url = 'https://' + url;
    }

    // Show loading, hide form + error
    scannerForm.style.display = 'none';
    loadingEl.style.display = 'flex';
    errorEl.style.display = 'none';

    // Linear loading steps (no looping)
    loadingTextEl.textContent = loadingSteps[0].text;
    progressFill.style.width = loadingSteps[0].progress + '%';

    const stepTimeouts = [];
    for (let i = 1; i < loadingSteps.length; i++) {
      stepTimeouts.push(setTimeout(() => {
        loadingTextEl.textContent = loadingSteps[i].text;
        progressFill.style.width = loadingSteps[i].progress + '%';
      }, loadingSteps[i].at));
    }

    // GA4 event
    if (typeof gtag === 'function') {
      gtag('event', 'scan_started', { scan_url: url });
    }

    try {
      const response = await fetch(SCANNER_API + '/api/scan', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ url: url })
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.error || 'Scan failed. Please try again.');
      }

      stepTimeouts.forEach(clearTimeout);
      progressFill.style.width = '100%';
      window.location.href = '/scan?id=' + data.scanId;
    } catch (err) {
      stepTimeouts.forEach(clearTimeout);
      scannerForm.style.display = 'block';
      loadingEl.style.display = 'none';
      progressFill.style.width = '0%';
      errorEl.textContent = err.message || 'Something went wrong. Please try again.';
      errorEl.style.display = 'block';
    }
  });
});

// Lazy Load Images
document.addEventListener('DOMContentLoaded', () => {
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
document.addEventListener('DOMContentLoaded', () => {
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
document.addEventListener('DOMContentLoaded', () => {
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
document.addEventListener('DOMContentLoaded', () => {
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
document.addEventListener('DOMContentLoaded', () => {
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
document.addEventListener('DOMContentLoaded', () => {
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
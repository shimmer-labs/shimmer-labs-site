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
    menuOverlay.style.display = 'block';
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

        galleryFeatured.innerHTML = '';

        if (type === 'video') {
          const iframe = document.createElement('iframe');
          iframe.src = src;
          iframe.setAttribute('frameborder', '0');
          iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
          iframe.setAttribute('allowfullscreen', '');
          galleryFeatured.appendChild(iframe);
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
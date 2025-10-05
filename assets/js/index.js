// Menu overlay functionality
const menuToggle = document.querySelector('.menu-toggle');
const menuOverlay = document.getElementById('menuOverlay');
const menuClose = document.querySelector('.menu-close');

// Open menu
menuToggle?.addEventListener('click', () => {
  menuOverlay.classList.add('active');
  document.body.style.overflow = 'hidden'; // Prevent scrolling
});

// Close menu
menuClose?.addEventListener('click', () => {
  menuOverlay.classList.remove('active');
  document.body.style.overflow = ''; // Restore scrolling
});

// Close on overlay background click
menuOverlay?.addEventListener('click', (e) => {
  if (e.target === menuOverlay) {
    menuOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }
});
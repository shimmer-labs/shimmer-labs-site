// Menu overlay functionality
document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.querySelector('.menu-toggle');
  const menuOverlay = document.getElementById('menuOverlay');
  const menuClose = document.querySelector('.menu-close');

  if (!menuToggle || !menuOverlay || !menuClose) return;

  // Open menu
  menuToggle.addEventListener('click', () => {
    menuOverlay.style.display = 'block';
    // Small delay for animation
    setTimeout(() => {
      menuOverlay.classList.add('active');
    }, 10);
    document.body.style.overflow = 'hidden';
  });

  // Close menu function
  const closeMenu = () => {
    menuOverlay.classList.remove('active');
    setTimeout(() => {
      menuOverlay.style.display = 'none';
    }, 300); // Match CSS transition time
    document.body.style.overflow = '';
  };

  // Close on button click
  menuClose.addEventListener('click', closeMenu);

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
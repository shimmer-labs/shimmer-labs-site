// Menu overlay functionality
const menuToggle = document.querySelector('.menu-toggle');
const menuOverlay = document.getElementById('menuOverlay');
const menuClose = document.querySelector('.menu-close');

// Open menu
menuToggle?.addEventListener('click', () => {
  menuOverlay.style.display = 'block';
  setTimeout(() => menuOverlay.classList.add('active'), 10);
  document.body.style.overflow = 'hidden';
});

// Close menu
const closeMenu = () => {
  menuOverlay.classList.remove('active');
  setTimeout(() => menuOverlay.style.display = 'none', 300);
  document.body.style.overflow = '';
};

menuClose?.addEventListener('click', closeMenu);
menuOverlay?.addEventListener('click', (e) => {
  if (e.target === menuOverlay) closeMenu();
});
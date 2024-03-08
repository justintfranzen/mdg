export const initContactUs = () => {
  const desktopWidth = window.matchMedia('(min-width: 981px)');

  const fixedContactBtn = document.querySelector('.fixed-contact-btn');

  if (desktopWidth.matches) {
    window.addEventListener('scroll', () => {
      const scroll = window.scrollY;
      if (scroll > 200) {
        fixedContactBtn.classList.add('show-contact-btn');
      } else {
        fixedContactBtn.classList.remove('show-contact-btn');
      }
    });
  }
};

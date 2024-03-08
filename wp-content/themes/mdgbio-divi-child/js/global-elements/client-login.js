export const initClientLogin = () => {
  const clientLogin = document.querySelector('.user-name');
  const clientLoginSection = document.querySelector('.client-login');
  const phoneNumber = document.querySelector('.phone');
  const mobileWidth = window.matchMedia('(max-width: 576px)');

  if (!clientLogin) {
    return;
  }

  if (mobileWidth.matches) {
    if (clientLogin) {
      clientLoginSection.classList.add('stack');
      phoneNumber.classList.add('phone-position');
    }
  }
};

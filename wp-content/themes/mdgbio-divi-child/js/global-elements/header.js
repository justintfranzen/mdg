export const initHeader = () => {
  const mobileMenuToggle =
    document.getElementsByClassName('mobile-menu-toggle');
  if (!mobileMenuToggle?.length) {
    return;
  }

  const mobileMenu = document.querySelectorAll('.menu-mobile-menu-container');

  mobileMenuToggle[0].addEventListener('click', () => {
    mobileMenuToggle[0].classList.toggle('close');
    mobileMenu.forEach((element) => {
      element.classList.toggle('open');
    });
  });

  const subMenuToggle = document.querySelectorAll('.menu-item-has-children a');
  for (let i = 0; i < subMenuToggle.length; i++) {
    subMenuToggle[i].addEventListener('click', () => {
      const menu = subMenuToggle[i].parentNode.querySelector(':scope > ul');
      menu.classList.toggle('open-sub-menu');
      subMenuToggle[i].classList.toggle('active-arrow');
    });
  }

  const btnSearch = document.querySelector('.search-icon-img');
  const searchField = document.querySelector('.search-icon');

  btnSearch.addEventListener('click', () => {
    searchField.classList.add('show-search');
    btnSearch.classList.add('hide-search-icon-img');
  });
};

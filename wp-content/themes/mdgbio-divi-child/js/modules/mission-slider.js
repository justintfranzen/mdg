export const missionSlideCount = () => {
  const section = document.querySelector('.mission-card-carousel');
  const fragment = document.querySelector('.mission-slider__current');

  if (!section) {
    return;
  }

  const slides = document.querySelectorAll(
    '.mission-card-carousel_slider .dsm_card_carousel_wrapper .swiper-slide',
  );
  const totalSlide = slides.length;

  slides.forEach((slide, i) => {
    i += 1;
    slide.setAttribute('data-index', i);
  });

  function slideCount(count) {
    if (fragment) {
      if (count > totalSlide) {
        count = 1;
      }
      const idx = count < 10 ? `0${count}` : count;
      const tdx = totalSlide < 10 ? `0${totalSlide}` : totalSlide;
      fragment.innerHTML = `${idx}/${tdx}`;
    }
  }

  function styleChangedCallback(mutations) {
    const newIndex = mutations[0].target.style.cursor;
    if (newIndex !== 'grabbing') {
      const slideActive = section.querySelector('.swiper-slide-active');
      const activeCount = slideActive.getAttribute('data-index');
      slideCount(activeCount);
    }
  }

  const observer = new MutationObserver(styleChangedCallback);
  observer.observe(
    section.querySelector('.mission-card-carousel .swiper-container'),
    {
      attributes: true,
      attributeFilter: ['style'],
    },
  );

  slideCount();

  const diviPrevArrow = section.querySelector('.swiper-button-prev');
  const diviNextArrow = section.querySelector('.swiper-button-next');

  const customPrevArrow = document.getElementById(
    'mission-card-carousel_custom-arrows-prev',
  );
  const customNextArrow = document.getElementById(
    'mission-card-carousel_custom-arrows-next',
  );

  const customPrevArrowMobile = document.getElementById(
    'mission-card-carousel_custom-arrows-prev-mobile',
  );
  const customNextArrowMobile = document.getElementById(
    'mission-card-carousel_custom-arrows-next-mobile',
  );

  customPrevArrow.addEventListener('click', (e) => {
    e.preventDefault();
    diviPrevArrow.click();
  });

  customNextArrow.addEventListener('click', (e) => {
    e.preventDefault();
    diviNextArrow.click();
  });

  customPrevArrowMobile.addEventListener('click', (e) => {
    e.preventDefault();
    diviPrevArrow.click();
  });

  customNextArrowMobile.addEventListener('click', (e) => {
    e.preventDefault();
    diviNextArrow.click();
  });
};

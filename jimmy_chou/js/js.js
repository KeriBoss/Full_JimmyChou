
  if ($(window).width() <= 990 && $(window).width() > 550) {

    document.addEventListener('DOMContentLoaded', function () {
      new Splide('.splide', {
        type: 'loop',
        perPage: 3,
        cover: true,
        focus: 'center',
        height: '30vh',
        gap: '1em'
      }).mount();
    });
  }
  else if ($(window).width() <= 560) {
    document.addEventListener('DOMContentLoaded', function () {
      new Splide('.splide', {
        type: 'loop',
        perPage: 1,
        cover: true,
        focus: 'center',
        height: '30vh'
      }).mount();
    });
  }
  else {
    document.addEventListener('DOMContentLoaded', function () {
      new Splide('.splide', {
        type: 'loop',
        perPage: 4,
        cover: true,
        focus: 'center',
        height: '30vh',
        gap: '1em',
        cover: true
      }).mount();
    });
  }



// --------------testimonial----------------

jQuery(document).ready(function($) {
    "use strict";
    $('#customers-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: true,
        dots:true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1170: {
            items: 3
          }
        }
    });
});

// ------------------filter gallery------------------
function showContent(tab) {
    if (tab === 'partners') {
      document.getElementById('partnersContent').classList.add('active');
      document.getElementById('supportersContent').classList.remove('active');
      document.getElementById('partners').style.backgroundColor = '#3fab40';
      document.getElementById('supporters').style.backgroundColor = 'rgb(119 213 121)';
    } else if (tab === 'supporters') {
      document.getElementById('supportersContent').classList.add('active');
      document.getElementById('partnersContent').classList.remove('active');
      document.getElementById('supporters').style.backgroundColor = '#3fab40';
      document.getElementById('partners').style.backgroundColor = 'rgb(119 213 121)';
    }
  }
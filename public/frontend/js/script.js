$(document).ready(function(){
  var url = window.location.href;
  $('.navbar-nav a.nav-link').each(function() {
      if (this.href === url) {
          $(this).addClass('active');
      }
  });
});

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

// ---------------preloader------------------

window.addEventListener('load', function() {
  // Hide the preloader when the page has finished loading
  var preloader = document.getElementById('preloader');
  $("#preloader").delay(500).fadeOut("slow");
});
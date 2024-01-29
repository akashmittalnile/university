

// ------------------filter gallery------------------
function showContent(tab) {
    if (tab === 'ebook') {
      document.getElementById('ebookContent').classList.add('active');
      document.getElementById('podcastsContent').classList.remove('active');
      document.getElementById('ebook').style.backgroundColor = '#3fab40';
      document.getElementById('podcasts').style.backgroundColor = 'rgb(119 213 121)';
    } else if (tab === 'podcasts') {
      document.getElementById('podcastsContent').classList.add('active');
      document.getElementById('ebookContent').classList.remove('active');
      document.getElementById('podcasts').style.backgroundColor = '#3fab40';
      document.getElementById('ebook').style.backgroundColor = 'rgb(119 213 121)';
    }
  }




  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 15,
    responsive: {
        0: {
            items: 1.3
        },
        640: {
            items: 2.5
        },
        795: {
            items: 2.5
        },
        1000: {
            items: 3.5
        }
    }
});
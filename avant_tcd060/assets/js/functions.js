(function($) {

  // Header
  var header = document.getElementById('js-header');

  if (header.classList.contains('l-header--fixed')) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 100) {
        header.classList.add('is-active');
      } else {
        header.classList.remove('is-active');
      }
    });
  }

  // search button
  if (document.getElementById('js-header__search') != null) {
  document.getElementById('js-header__search').addEventListener('click', function() {
    this.classList.toggle('is-active');
    if (this.classList.contains('is-active')) {
      document.getElementById('js-header__form').firstElementChild.focus();
    }
  });
  }

  // Global navigation
  var globalNavToggle = document.getElementsByClassName('p-global-nav__toggle');

  document.getElementById('js-menu-btn').addEventListener('click', function(e) {
    e.preventDefault();
    this.classList.toggle('is-active');
    $('#js-global-nav').slideToggle();
  }, false);

  for (var i = 0, len = globalNavToggle.length; i < len; i++) {
    globalNavToggle[i].addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('is-active');
      $(this).parent('a').next('.sub-menu').slideToggle();
    });
  }


  function mediaQueryClass(width) {
    if (width > 1199) { //PC
      $(".p-global-nav").css("display","block");
      $(".sub-menu").css("display","block");
    } else { //smart phone
      $(".p-global-nav").css("display","none");
      $(".p-global-nav__toggle").removeClass("is-active");
      $(".sub-menu").css("display","none");
    };
  };
  function viewport() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
  }
  var ww = viewport().width;
  mediaQueryClass(ww);
  $(window).bind("resize orientationchange", function() {
    var ww = viewport().width;
    mediaQueryClass(ww);
  })


  // Pagetop
  var pagetop = document.getElementById('js-pagetop');

  window.addEventListener('scroll', function() {
    if (window.scrollY > 100) {
      pagetop.classList.add('is-active');
    } else {
      pagetop.classList.remove('is-active');
    }
  });

  pagetop.addEventListener('click', function(e) {
    $('body, html').animate({
      scrollTop: 0
    }, 1000);
    e.preventDefault();
  });

  // Widget: Archive list
  var dropdownTitle = document.getElementsByClassName('p-dropdown__title');

  for (var i = 0, len = dropdownTitle.length; i < len; i++) {
    dropdownTitle[i].addEventListener('click', function() {
      this.classList.toggle('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }

  // Comment
  if ($('#js-comment__tab').length) {
    var commentTab = $('#js-comment__tab');
    commentTab.find('a').click(function(e) {
      e.preventDefault();
      if (!$(this).parent().hasClass('is-active')) {
        $($('.is-active a', commentTab).attr('href')).animate({opacity: 'hide'}, 0);
        $('.is-active', commentTab).removeClass('is-active');
        $(this).parent().addClass('is-active');
        $($(this).attr('href')).animate({opacity: 'show'}, 1000);
      }
    });
  }

  // Slider
  if ($('#js-calendar').length) {
    $('#js-calendar').slick({
      infinite: false,
      slidesToShow: 11,
      responsive: [
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 10
          }
        },
        {
          breakpoint: 1180,
          settings: {
            slidesToShow: 9
          }
        },
        {
          breakpoint: 1080,
          settings: {
            slidesToShow: 8
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 10
          }
        },
        {
          breakpoint: 902,
          settings: {
            slidesToShow: 9
          }
        },
        {
          breakpoint: 812,
          settings: {
            slidesToShow: 8
          }
        },
        {
          breakpoint: 768,
          settings: 'unslick'
        }
      ]
    });

  }
  if ($('.js-slider').length) {
    $('.js-slider').slick({
      autoplay: true,
      dots: true,
      slide: '.p-slider__item',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            dots: false
          }
        }
      ]
    });
  }

})(jQuery);

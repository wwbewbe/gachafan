(function($) {
  $(function($) {
    var navfit = $('.main-navi');
    var navtop = navfit.offset().top;
    $(window).scroll(function () {
    if($(window).scrollTop() > navtop) {
      navfit.addClass('fixed');
    } else {
      navfit.removeClass('fixed');
    }
    });
  });
})(jQuery);

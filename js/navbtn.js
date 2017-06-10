// トグルボタン
jQuery(function(){
  jQuery("#navbtn").click(function(){
    jQuery("#header-nav").stop(true,true).slideToggle();
  });
});

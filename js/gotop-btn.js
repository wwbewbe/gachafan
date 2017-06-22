//フローティングメニュー（全画面右下に表示）
jQuery(function() {
    var gotopBtn = jQuery('.gotop-btn');
    gotopBtn.hide();
    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() > 300) {
            gotopBtn.fadeIn();
        } else {
            gotopBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    gotopBtn.click(function () {
        jQuery('body,html').animate({
					scrollTop: 0 }, 500);
        return false;
    });
});

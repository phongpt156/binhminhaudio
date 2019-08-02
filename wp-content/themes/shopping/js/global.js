jQuery(document).ready(function(e) {jQuery('ul').each(function(){ jQuery(this).find('li:last').addClass('last'); });jQuery('ul').each(function(){ jQuery(this).find('li:first').addClass('first'); });
    //new WOW().init();
    jQuery('.scrollTo').on('click', scrollToTop);
    function scrollToTop() {verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;element = jQuery('body');offset = element.offset();offsetTop = offset.top;jQuery('html, body').animate({scrollTop: offsetTop}, 500, 'linear');}
    // Menu Mobile
    jQuery(".navbar-toggle").click(function(e){
        jQuery('body').toggleClass('mnopen');
        e.stopPropagation();

    })
    jQuery(".close-menu").click(function(){
        jQuery('body').removeClass('mnopen');
    })
    jQuery('html').click(function() {
        if(jQuery('#off-canvas').css('visibility') == 'visible'){
            jQuery('body').removeClass('mnopen');
        }
    });
    jQuery('#off-canvas').click(function(e){
        e.stopPropagation();
    });
    //menu
    jQuery("#off-canvas .sub-menu").hide();
    jQuery("#off-canvas ul li").click(function(){
        if (jQuery(this).find("ul.sub-menu").length > 0) {
            jQuery(this).find("ul.sub-menu").show();
        }
    });
    jQuery(window).scroll(function(){
        var height = 220;
        if (jQuery(window).scrollTop() < height) {
            jQuery('.wrapper-menu').removeClass('menu-fixed');
            jQuery('.mobile-wrapper').removeClass('menu-fixed');
        } else {
            jQuery('.wrapper-menu').addClass('menu-fixed');
            jQuery('.mobile-wrapper').addClass('menu-fixed');
        }
    });
    
    jQuery('#mega2').dcVerticalMegaMenu();
    
    jQuery( ".wrapper-menu .col-lg-3" ).hover(
        function() {
            jQuery('.wrapper-menu .mega-menu2').css('display','block');
        },function(){
            jQuery('.wrapper-menu .mega-menu2').css('display','none');
        }
    );
    /* ToggleClass */
    jQuery(".icon-search").click(function(){
        jQuery('.wrap-search').toggleClass('search-active');
    });
    /* Remove ToggleClass */
    jQuery(".btn-close").click(function(){
        jQuery('.wrap-search').removeClass('search-active');
    });
    // Scroll to Top
    jQuery(document).on( 'scroll', function(){
        if (jQuery(window).scrollTop() > 500) {
            jQuery('.scrollTo').addClass('show');
        } else {
            jQuery('.scrollTo').removeClass('show');
        }
    });
    jQuery('.scrollTo').on('click', scrollToTop);
    function scrollToTop() {
        var verticalOffset, element, offset, offsetTop;
        verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        element = jQuery('body');
        offset = element.offset();
        offsetTop = offset.top;
        jQuery('html, body').animate({
            scrollTop: offsetTop
        }, 500, 'linear');
    }
    // Check mail Contact Form 7
    jQuery(".wpcf7").on('wpcf7:mailfailed', function(event){
        alert('Hosting của bạn chưa được cấu hình gửi mail. Hãy liên hệ với nhà cung cấp hosting hoặc đọc hướng dẫn ở đây để tự cấu hình: http://e-web.vn/huong-dan-cau-hinh-gui-mail-smtp-wordpress/');
    });
});
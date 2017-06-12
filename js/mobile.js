;
(function($) {
    $(function(){
        var ele = $('.nav-wrapper');
        var navToggle = ele.find('.navbar-toggle');
        var nav = ele.find('nav');
        var navList = nav.find('> ul');
        
        ele.on('click', navToggle, function(e) {
            navList.toggleClass('show');
        });
    });
})(jQuery);
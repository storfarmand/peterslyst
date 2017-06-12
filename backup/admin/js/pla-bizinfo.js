; (function($) {

    $(function() {
        $("#pbSaveFInfo").bind('click', function(e) {
            e.preventDefault();
            var qString = {};
            qString.bz_name    = $("#txtFName").val();
            qString.bz_address = $("#txtFAddress").val();
            qString.bz_city = $("#txtFCity").val();
            qString.bz_zip = $("#txtFZip").val();
            qString.bz_tele    = $("#txtFTele").val();
            qString.bz_email   = $("#txtFEmail").val();
            $.post(cms_launch+"php/pla-ajax-functions.php?action=saveFInfo", qString, function (theResult) {
                $.blockUI({
                    message: theResult,
                    fadeIn: 2000,
                    fadeOut: 2000,
                    timeout: 3000,
                    showOverlay: false,
                    css: {
                        top: '60px',
                        width: '350px',
                        border: 'none',
                        padding: '5px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .8,
                        color: '#fff'
                    }
                });
            }); 
        });
        
    });
    
})(jQuery);

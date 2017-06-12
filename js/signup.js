; (function($) {
    
    var ajaxUrl = "http://www.peterslyst.com/php/pl-ajax-functions.php";
    
    $(function(){
        $('.news-signup').on('click', '[type="submit"]', function(e){
            e.preventDefault();
            var container = $(this).parents('.news');
            var name=container.find('input[name=newsname]').val().trim();
            var email=container.find('input[name=newsemail]').val().trim();
            var phone=container.find('input[name=newstele]').val().trim();
            if (!validateEmail(email)) {
                alert('email adresse is invalid');
                return;
            }
            var requestUrl = ajaxUrl + '?action=signup&type=happenings&newsname=' + name + '&newsemail=' + email + '&newstele=' + phone
            $.post(requestUrl, function(data){
                var response = $.parseJSON(data);
                var responseHTML = "";
                switch (response.code) {
                    case 0:
                        responseHTML = "<p>Tak for din tilmelding! Du har tilmeldt " + response.details.email + " til vores nyhedsbrev.</p><p>Vi lover vi ikke spammer dig, du modtager kun mail fra os når der er gode nyheder. Skulle du alligevel fortryde, kan du til enhver tid afmelde nyhedsbrevet.</p>"
                        break;
                    case 1062:
                        responseHTML = "<p>Den indtastede mail adresse eksisterer allerede.</p>"
                        break;
                    default:
                        return;
                }
                container.replaceWith(responseHTML);
            });
        });
    });
})(jQuery);
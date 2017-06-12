; (function($) {

    $(function() {

        $('form[id^="frm_campaign_"]').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
           },
            complete: function(xhr) {
                var response = xhr.responseText;
                status.html((response.code == "0" ? "Upload fuldført" : "Upload fejl"));
                status.html(xhr.responseText);
                $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=getCampaign", function (campaignData) {
                    var picURL = site_base + "_kampagne/" + campaignData.c_pic + "?" + Math.random();
                    $("#campaignPicPreview img").attr({'src': picURL});
                    var pdfURL = site_base + "_kampagne/" + campaignData.c_pdf;
                    $("#campaignPDFPreview").empty();
                    var campaignPDF = new PDFObject({url: pdfURL}).embed("#campaignPDFPreview");
                });
            }
        });

    });

})(jQuery);

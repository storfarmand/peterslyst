;
(function($, document, undefined) {

    $(function() {

        tinyMCE.init({
            mode : "exact",
            elements : "taProductText",
            theme : "advanced",
            width : "600",
            height : "200",
            inline_styles : true,
            theme_advanced_disable : "styleselect,outdent,indent,image,cleanup,help,code,removeformat,charmap,visualaid,sub,sup,charmap",
            theme_advanced_buttons1 : "bold,italic,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,formatselect,|,link,unlink,anchor,|,undo,redo",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            theme_advanced_buttons4 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left"

        });

        var navEle = $('#navcontainer');
        var navToggle = navEle.find('.navbar-toggle');
        var navList = navEle.find('.nav-tabs');
        
        navToggle.bind('click', function() {
            navList.toggleClass('show');
        });

        $("#selProduct").bind('change', function() {
            var p_id = $(this).val();
            if(p_id < 0) {
                $("#txtProductModel").val("");
                $("#txtProductTitle").val("");
                var taProductText = tinyMCE.get('taProductText');
                taProductText.setContent("");
                var picURL = site_base + "_products/emptyProduct.png";
                $("#productPicPreview img").attr({'src': picURL});
                var pdfURL = site_base + "_products/emptyProduct.pdf";
                $("#productPDFPreview").empty();
                var productPDF = new PDFObject({url: pdfURL}).embed("productPDFPreview");
            }
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=getProduct&p_id="+p_id, function (productData) {
                $("#txtProductModel").val(productData.p_model);
                $("#txtProductTitle").val(productData.p_title);
                var taProductText = tinyMCE.get('taProductText');
                taProductText.setContent((typeof productData.p_text != null) ? productData.p_text : "");
                if(productData.p_active == "Y") $("#cbProductActive").attr('checked', 'checked')
                else $("#cbProductActive").removeAttr('checked')
                var picURL = site_base + "_products/" + productData.p_pic;
                $("#productPicPreview img").attr({'src': picURL});
                var pdfURL = site_base + "_products/" + productData.p_pdf;
                $("#productPDFPreview").empty();
                var productPDF = new PDFObject({url: pdfURL}).embed("productPDFPreview");
            });
        });
        
        $("#pbSaveProduct").bind('click', function(e) {
            e.preventDefault();
            var qString = {};
            var p_id = qString.p_id = $("#selProduct").val();
            if (p_id < 0) return;
            qString.p_model  = $("#txtProductModel").val();
            qString.p_title  = $("#txtProductTitle").val();
            var taProductText = tinyMCE.get('taProductText');
            qString.p_text  = taProductText.getContent();
            qString.p_active = ($("#cbProductActive").attr("checked") == "checked") ? 'Y' : 'N';
            $.post(cms_launch+"php/jea-ajax-functions.php?action=saveProduct", qString, function (theResult) {
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
        
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');
        
        $('form[id^="frm_product_"]').ajaxForm({
            beforeSubmit: function(formData, jqForm) {
                formData.push({'name': 'product_num', 'value': $("#selProduct").val()})
            },
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
                var response = $.parseJSON(xhr.responseText);
                status.html((response.code == "0" ? "Upload fuldført" : "Upload fejl"));
                var p_id = $("#selProduct").val();
                $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=getProduct&p_id="+p_id, function (productData) {
                    var picURL = site_base + "_products/" + productData.p_pic + "?" + Math.random();
                    $("#productPicPreview img").attr({'src': picURL});
                    var pdfURL = site_base + "_products/" + productData.p_pdf;
                    $("#productPDFPreview").empty();
                    var productPDF = new PDFObject({url: pdfURL}).embed("productPDFPreview");
                });
            }
        });
        
        if ($("#campaignPDFPreview").length > 0) {
            var pdfURL = site_base + "_kampagne/kampagne.pdf";
            $("#campaignPDFPreview").empty();
            var campaignPDF = new PDFObject({url: pdfURL}).embed("campaignPDFPreview");
        }
        
        $("#pbNewProduct").bind('click', function () {
            if(trim($("#txtProductModel").val()) == "") {
                alert('Model nr felt skal indholde noget tekst');
                return;
            }
            var p_model = $("#txtProductModel").val();
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=newProduct&p_model=" + p_model, function (productData) {
                $("#selProduct").append($("<option>").val(productData.p_id).html(productData.p_model)).val(productData.p_id);
                var message = "Produkt " + productData.p_model + " blev tilføjet";
                $.blockUI({
                    message: message,
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

        $("#pbDelProduct").bind('click', function () {
            if($("#selProduct").val() < 0) {
                alert('Du skal vælge et produkt');
                return;
            }
            var p_id = $("#selProduct").val();
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=delProduct&p_id=" + p_id, function (productData) {
                $("#selProduct option[value='"+p_id+"']").remove();
                $("#txtProductModel").val("");
                $("#txtProductTitle").val("");
                var taProductText = tinyMCE.get('taProductText');
                taProductText.setContent("");
                var picURL = site_base + "_products/empty.png";
                $("#productPicPreview img").attr({'src': picURL});
                var message = "Produkt blev slettet";
                $("#productPDFPreview").empty();
                $.blockUI({
                    message: message,
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
                    var campaignPDF = new PDFObject({url: pdfURL}).embed("campaignPDFPreview");
                });
            }
        });

        $("#pbSaveFInfo").bind('click', function(e) {
            e.preventDefault();
            var qString = {};
            qString.bz_name    = $("#txtFName").val();
            qString.bz_address = $("#txtFAddress").val();
            qString.bz_zipcity = $("#txtFZipCity").val();
            qString.bz_tele    = $("#txtFTele").val();
            qString.bz_email   = $("#txtFEmail").val();
            $.post(cms_launch+"php/jea-ajax-functions.php?action=saveFInfo", qString, function (theResult) {
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

})(jQuery, document)
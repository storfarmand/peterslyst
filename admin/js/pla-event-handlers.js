;
(function($, document, undefined) {

    $(function() {

        tinyMCE.init({
            license_key: 'gpl',
            selector : "#taGEDesc",
            skin: 'oxide-dark',
            content_css: "dark",
            width : "600",
            height : "400",
            inline_styles : true
        });

        var navEle = $('#navcontainer');
        var navToggle = navEle.find('.navbar-toggle');
        var navList = navEle.find('.nav-tabs');
        
        navToggle.bind('click', function() {
            navList.toggleClass('show');
        });

        $("#selElement").bind('change', function() {
            var GE_id = $(this).val();
            if(GE_id < 0) {
                $("#txtGEName").val("");
                $("#txtGETitle").val("");
                var taGEDesc = tinymce.get('taGEDesc');
                taGEDesc.setContent("");
/*
                var picURL = site_base + "_products/emptyProduct.png";
                $("#productPicPreview img").attr({'src': picURL});
                var pdfURL = site_base + "_products/emptyProduct.pdf";
                $("#productPDFPreview").empty();
                var productPDF = new PDFObject({url: pdfURL}).embed("productPDFPreview");
*/
            }
            $.getJSON(cms_launch+"php/pla-ajax-functions.php?action=getElement&GEid="+GE_id, function (eleData) {
                $("#txtGEName").val(eleData.GEid);
                $("#txtGETitle").val(eleData.title);
                var taGEDesc = tinymce.get('taGEDesc');
                taGEDesc.setContent((typeof eleData.desc != null) ? eleData.desc : "");
/*
                if(productData.p_active == "Y") $("#cbProductActive").attr('checked', 'checked')
                else $("#cbProductActive").removeAttr('checked')
                var picURL = site_base + "_products/" + productData.p_pic;
                $("#productPicPreview img").attr({'src': picURL});
                var pdfURL = site_base + "_products/" + productData.p_pdf;
                $("#productPDFPreview").empty();
                var productPDF = new PDFObject({url: pdfURL}).embed("productPDFPreview");
*/
            });
        });
        
        $("#pbSaveGE").bind('click', function(e) {
            e.preventDefault();
            var qString = {};
            var GE_id = qString.GEid = $("#selElement").val();
            if (GE_id < 0) return;
            qString.title  = $("#txtGETitle").val();
            var taGEDesc = tinyMCE.get('taGEDesc');
            qString.desc  = taGEDesc.getContent();
            $.post(cms_launch+"php/pla-ajax-functions.php?action=saveGE", qString, function (theResult) {
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
                $.getJSON(cms_launch+"php/pla-ajax-functions.php?action=getProduct&p_id="+p_id, function (productData) {
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
            $.getJSON(cms_launch+"php/pla-ajax-functions.php?action=newProduct&p_model=" + p_model, function (productData) {
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
            $.getJSON(cms_launch+"php/pla-ajax-functions.php?action=delProduct&p_id=" + p_id, function (productData) {
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
                $.getJSON(cms_launch+"php/pla-ajax-functions.php?action=getCampaign", function (campaignData) {
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

})(jQuery, document)
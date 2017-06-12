(function($) {

    $(function() {


/***** START - Item Event Handlers *****/


        var salesForm = $('form[id^="frm_sales"]');
        salesForm.ajaxForm();
        
        tinyMCE.init({
            mode : "exact",
            elements : "taItemDesc",
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

        var itemEle = $(".items");
        $(itemEle).on('change', '.itemlist', function() {
            log("Item changed");
            var i_id = $(this).val();
            var details = itemEle.find(".details");
            var cat1list = details.find(".cat1list");
            var brandlist = details.find(".brandlist");
            var title = details.find(".title");
            var price = details.find(".price");
            var qty = details.find(".qty");
            var active = details.find(".active");
            var title = details.find(".title");
            var desc = tinyMCE.get('taItemDesc');
            var pic = details.find(".pic");
            var pdf = details.find(".pdf");
            if(i_id < 0) {
                title.val("");
                desc.setContent("");
                pic.find("img").attr({"src": ""});
            } else {
                $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=getItem&i_id="+i_id, function (itemData) {
                    brandlist.val(itemData.i_brand);
                    cat1list.val(itemData.i_cat1);
                    cat1list.trigger({
                        type:"change",
                        cat2:itemData.i_cat2
                    });
                    desc.setContent(itemData.i_text);
                    title.val(itemData.i_title);
                    price.val(itemData.i_price);
                    qty.val(itemData.i_qty);
                    active.prop('checked', itemData.i_active == "1" ? true : false);
                    var picURL = site_base + "_items/" + i_id + "/" + itemData.i_pic;
                    pic.find("img").attr({'src': picURL});
                    var pdfURL = site_base + "_items/" + i_id + "/" + itemData.i_pdf;
                    $("#itemPDFPreview").empty();
                    var itemPDF = new PDFObject({url: pdfURL}).embed("itemPDFPreview");                });
            }
        });

        $(itemEle).on('change', '.cat1list', function(e) {
            log("Cat1 changed");
            log(e.cat2);
            cat1idx = $(this).val();
            var cat2list = $(this).parent().find(".cat2list");
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=getCat2&cat1_idx="+cat1idx, function (cat2values) {
                cat2list.empty();
                cat2list.append($("<option>").val("-1").html("- ingen -"));
                $.each(cat2values, function(cat2idx, cat2name) {
                    cat2list.append($("<option>").val(cat2idx).html(cat2name));
                });
                if(typeof e.cat2 !== "undefined") {
                    cat2list.val(e.cat2);
                }
            });
        });

        $(itemEle).on('click', '.save', function(e) {
            log("Saving item info")
            e.preventDefault();
            var itemData = {};
            var i_id = itemData.i_id = itemEle.find(".itemlist").val();
            if (i_id < 0) return;
            itemData.i_title  = itemEle.find(".title").val();
            var i_desc = tinyMCE.get('taItemDesc').getContent();
            itemData.i_desc  = i_desc;
            itemData.i_price  = itemEle.find(".price").val();
            itemData.i_qty  = itemEle.find(".qty").val();
            itemData.i_active  = itemEle.find(".active").prop('checked') ? "1" : "0";
            itemData.i_cat  = itemEle.find(".cat2list").val();
            itemData.i_brand  = itemEle.find(".brandlist").val();
            $.post(cms_launch+"php/jea-ajax-functions.php?action=saveItem", itemData, function (theResult) {
                itemEle.find(".itemlist option[value='"+i_id+"']").text(itemData.i_title);
                showResult(theResult);
            }); 
        });
        
        $(itemEle).on('click', '.new', function(e) {
            log("Creating new item");
            e.preventDefault();
            var itemText = itemEle.find(".title");
            if(trim(itemText.val()) == "") {
                alert('Tekst felt skal indholde noget tekst');
                return;
            }
            var i_text = itemText.val();
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=newItem&i_title=" + i_text, function (itemData) {
                itemEle.find(".itemlist").append($("<option>").val(itemData.i_id).html(itemData.i_title)).val(itemData.i_id);
                var message = "Item " + itemData.t_text + " blev tilføjet";
                showResult(message);
            });
        });

        $(itemEle).on('click', '.delete', function(e) {
            log("Deleteing item");
            e.preventDefault();
            var i_id = itemEle.find(".itemlist").val();
            if(i_id < 0) {
                alert('Du skal vælge et item');
                return;
            }
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=delItem&i_id=" + i_id, function (itemData) {
                itemEle.find(".itemlist option[value='"+i_id+"']").remove();
                itemEle.find(".itemlist").val("-1");
                $(".itemlist").trigger("change");
                var message = "Item " + itemData.text + " blev slettet";
                showResult(message);
            });
        });

        $(itemEle).on('click', '.swap-picture', function(e) {
            if ($(this).siblings(".new-picture").val().length == 0) { return; }
            log("Swapping picture");
            e.preventDefault();
            var i_id = itemEle.find(".itemlist").val();
            if(i_id < 0) {
                alert('Du skal vælge et item');
                return;
            }
            
            salesForm.ajaxSubmit({
                url: cms_launch+"php/jea-ajax-functions.php"
              , data: {
                      action: "swapItemPic"
                    , i_id:  i_id
                }
              , complete: function(xhr) {
                    var response = $.parseJSON(xhr.responseText);
                    itemEle.find(".itemlist").trigger("change");
                    showResult("Billede byttede med " + response.i_logo);
                }               
            });
            
        });

        $(itemEle).on('click', '.swap-pdf', function(e) {
            if ($(this).siblings(".new-pdf").val().length == 0) { return; }
            log("Swapping PDF");
            e.preventDefault();
            var i_id = itemEle.find(".itemlist").val();
            if(i_id < 0) {
                alert('Du skal vælge et item');
                return;
            }
            
            salesForm.ajaxSubmit({
                url: cms_launch+"php/jea-ajax-functions.php"
              , data: {
                      action: "swapItemPDF"
                    , i_id:  i_id
                }
              , complete: function(xhr) {
                    var response = $.parseJSON(xhr.responseText);
                    itemEle.find(".itemlist").trigger("change");
                    showResult("PDF byttede med " + response.i_pdf);
                }               
            });

        });

/***** END - Item Event Handlers *****/



/***** START - Brand Event Handlers *****/


        var brandEle = $(".brands");
        $(brandEle).on('change', '.brandlist', function() {
            log("Brand changed");
            var b_idx = $(this).val();
            var details = brandEle.find(".details");
            var name = details.find(".text");
            var logo = details.find(".logo");
            if(b_idx < 0) {
                name.val("");
                logo.find("img").attr({"src": ""});
            } else {
                $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=getBrand&b_idx="+b_idx, function (brandData) {
                    name.val(brandData.b_text);
                    var logoURL = site_base + "_brands/" + b_idx + "/" + brandData.b_logo;
                    logo.find("img").attr({'src': logoURL});
                });
            }
        });

        $(brandEle).on('click', '.save', function(e) {
            log("Saving brand info")
            e.preventDefault();
            var brandData = {};
            var b_idx = brandData.b_idx = brandEle.find(".brandlist").val();
            if (b_idx < 0) return;
            brandData.b_text  = brandEle.find(".text").val();
            $.post(cms_launch+"php/jea-ajax-functions.php?action=saveBrand", brandData, function (theResult) {
                brandEle.find(".brandlist option[value='"+b_idx+"']").text(brandData.b_text);
                showResult(theResult);
            }); 
        });
        
        $(brandEle).on('click', '.new', function(e) {
            e.preventDefault();
            var brandText = brandEle.find(".text");
            if(trim(brandText.val()) == "") {
                alert('Tekst felt skal indholde noget tekst');
                return;
            }
            var b_text = brandText.val();
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=newBrand&b_text=" + b_text, function (brandData) {
                brandEle.find(".brandlist").append($("<option>").val(brandData.b_idx).html(brandData.b_text)).val(brandData.b_idx);
                itemEle.find(".brandlist").append($("<option>").val(brandData.b_idx).html(brandData.b_text));
                var message = "Mærke " + brandData.b_text + " blev tilføjet";
                showResult(message);
            });
        });

        $(brandEle).on('click', '.delete', function(e) {
            e.preventDefault();
            var b_idx = brandEle.find(".brandlist").val();
            if(b_idx < 0) {
                alert('Du skal vælge et mærke');
                return;
            }
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=delBrand&b_idx=" + b_idx, function (brandData) {
                brandEle.find(".brandlist option[value='"+b_idx+"']").remove();
                brandEle.find(".brandlist").val("-1");
                $(".brandlist").trigger("change");
                var message = "Mærke " + brandData.text + " blev slettet";
                showResult(message);
            });
        });

        $(brandEle).on('click', '.swap-logo', function(e) {
            if ($(this).siblings(".new-logo").val().length == 0) { return; }
            log("Swapping logo");
            e.preventDefault();
            var b_idx = brandEle.find(".brandlist").val();
            if(b_idx < 0) {
                alert('Du skal vælge et mærke');
                return;
            }
            
            salesForm.ajaxSubmit({
                url: cms_launch+"php/jea-ajax-functions.php"
              , data: {
                      action: "swapLogo"
                    , b_idx:  b_idx
                }
              , complete: function(xhr) {
                    var response = $.parseJSON(xhr.responseText);
                    brandEle.find(".brandlist").trigger("change");
                    showResult("Logo byttede med " + response.b_logo);
                }               
            });

        });

/***** END - Brand Event Handlers *****/


/***** START - Category Event Handlers *****/


        var catEle = $(".cats");
        $(catEle).on('change', '.maincatlist', function() {
            log("Main catlist changed");
            var mc_idx = $(this).val();
            var subCatList = catEle.find(".subcatlist");
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=getSubCats&c_idx="+mc_idx, function (subCatData) {
                subCatList.empty();
                subCatList.append('<option value="-1" selected="selected">- ingen -</option>');
                $.each(subCatData.subCatList, function(idx, val){
                    log(idx + val);
                    subCatList.append('<option value="' + idx + '">' + val + '</option>');
                });
                $(catEle).find('.subcatlist').trigger('change');
            });
        });

        $(catEle).on('change', '.subcatlist', function() {
            log("Sub catlist changed");
            var selectedText = $("option:selected", this).text();
            var text = catEle.find(".text");
            text.val(selectedText == '- ingen -' ? "" : $("option:selected", this).text());
        });

        $(catEle).on('click', '.save', function(e) {
            log("Saving cat text info")
            e.preventDefault();
            var catData = {};
            catData.cat_idx = catEle.find(".subcatlist").val();
            if (catData.cat_idx < 0) return;
            catData.cat_name  = catEle.find(".text").val();
            $.post(cms_launch+"php/jea-ajax-functions.php?action=saveCat", catData, function (theResult) {
                catEle.find(".subcatlist option[value='"+catData.cat_idx+"']").text(catData.cat_name);
                showResult(theResult);
            }); 
        });
        
        $(catEle).on('click', '.new', function(e) {
            e.preventDefault();
            var cat_owner = catEle.find(".maincatlist").val();
            if (cat_owner < 0) return; 
            var catText = catEle.find(".text");
            var cat_name = catText.val();
            if(trim(cat_name) == "") {
                alert('Kategori tekst felt skal indholde noget tekst');
                return;
            }
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=newCat&cat_owner=" + cat_owner + "&cat_name=" + cat_name, function (catData) {
                catEle.find(".subcatlist").append($("<option>").val(catData.cat_idx).html(catData.cat_name)).val(catData.cat_idx);
                var itemMainCat = itemEle.find('.cat1list').val();
                if (itemMainCat == cat_owner) {
                    itemEle.find(".cat2list").append($("<option>").val(catData.cat_idx).html(catData.cat_name));
                }
                var message = "Kategori " + catData.b_text + " blev tilføjet";
                showResult(message);
            });
        });

        $(catEle).on('click', '.delete', function(e) {
            e.preventDefault();
            var cat_idx = catEle.find(".subcatlist").val();
            if(cat_idx < 0) {
                alert('Du skal vælge en kategori');
                return;
            }
            var catText = $("option:selected", catEle.find(".subcatlist")).text();
            if (!confirm("Slet " + catText + " ?")) { return; }
            $.getJSON(cms_launch+"php/jea-ajax-functions.php?action=delCat&cat_idx=" + cat_idx, function (catData) {
                catEle.find(".subcatlist option[value='"+cat_idx+"']").remove();
                itemEle.find(".cat2list option[value='"+cat_idx+"']").remove();
                catEle.find(".subcatlist").val("-1");
                $(".subcatlist").trigger("change");
                var message = "Kategori " + catData.name + " blev slettet";
                showResult(message);
            });
        });


/***** END - Category Event Handlers *****/


        $(".catlist").bind('change', function() {
            log('Index: ' + $(this).index() );
            log('Val: ' + $(this).val() );
        });

    });
    
})(jQuery);

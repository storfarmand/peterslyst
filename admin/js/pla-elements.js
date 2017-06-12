;
(function() {
    $(function() {
        
        var detailsForm = $('form[id="frm_ele_details"]');
        var mediaForm = $('form[id="frm_ele_media"]');
        
        //Element select
        var eleSel = detailsForm.find('[name="sel-ele"]');

        // Element attributes
        var eleTitle = detailsForm.find('[name="txt-ele-title"]');
        var eleType = detailsForm.find('[name="sel-ele-type"]');
        var eleDescObj, eleDesc;
        var eleHeader = detailsForm.find('[name="txt-ele-header"]');
        var eleHeaderActive = detailsForm.find('[name="cb-ele-header"]');
        var eleFooter = detailsForm.find('[name="txt-ele-footer"]');
        var eleFooterActive = detailsForm.find('[name="cb-ele-footer"]');
        var eleSize = detailsForm.find('[name="sel-ele-size"]');
        var eleBg = detailsForm.find('[name="rb-ele-bg"]');

        //Media attributes
        var eleMediaPreview = mediaForm.find(".ele-media-preview img");

        //Buttons
        var eleSave = detailsForm.find('[name="pb-ele-save"]');
        var eleDel = detailsForm.find('[name="pb-ele-del"]');
        var mediaFileBtn = mediaForm.find('[name=fil-ele-media]')
        var mediaNewBtn = mediaForm.find('[name=pb-ele-media]')
        var btns = new Array();
        btns.push(eleSave, eleDel, mediaNewBtn, mediaFileBtn);

        var buttonState = function(buttons, state) {
            $.each(buttons, function(idx, $btn) {
                state === "disabled" ? $btn.attr("disabled", true) : $btn.removeAttr("disabled");
            });
        };

        var formReset = function() {
            detailsForm.find('input[type=text], textarea').each(function() {
                $(this).val('');
            });
            detailsForm.find('input[type=checkbox]').each(function() {
                $(this).removeAttr('checked');
            });
            detailsForm.find('input[name=rb-ele-bg][value=default]').attr('checked', true);
            detailsForm.find('select[name=sel-ele-type]').val('T');
            detailsForm.find('select[name=sel-ele-size]').val('S');
            mediaForm.find('.ele-media-preview img').attr('src', '');
            buttonState(btns, "disabled");
            eleDescObj.setContent('');
        };

        eleSel.on('change', function(e) {
            var newIdx = $(this).val();
            
            if (newIdx === "-1") {
                formReset();
                return;
            }
            
            buttonState(btns, "enabled");
            var ajaxRequest = cms_ajax_launch + '?action=getElement&idx=' + newIdx;
            $.getJSON(uniqueURL(ajaxRequest), function(data) {
                var gridElement = data;
                eleTitle.val(gridElement.title);
                eleType.val(gridElement.type);
                eleDescObj.setContent(gridElement.desc !== null ? gridElement.desc : '');
                eleHeader.val(gridElement.header);
                eleHeaderActive.removeAttr('checked').attr('checked', gridElement.showheader === 'Y' ? true : false);
                eleFooter.val(gridElement.footer);
                eleFooterActive.removeAttr('checked').attr('checked', gridElement.showfooter === 'Y' ? true : false);
                eleSize.val(gridElement.size);
                var decorations = gridElement.decorations.trim().length > 0 ? gridElement.decorations.split(',') : [];
                $.each(decorations, function(idx, decoration) {
                    switch (decoration) {
                        case "dirt":
                            eleBg.siblings('[value=dirt]').attr('checked', true);
                            break;
                        case "chalkboard":
                            eleBg.siblings('[value=chalkboard]').attr('checked', true);
                            break;
                        default:
                            eleBg.siblings('[value=default]').attr('checked', true);
                    }
                });
                
                eleMediaPreview.attr('src', gridElement.img !== null ? siteMediaBase + gridElement.idx + '/' + gridElement.img : '');
                
            });
        });
        
        eleSave.on('click', function(e) {
            e.preventDefault();
            var idx = eleSel.val();
            var eleDesc = eleDescObj.getContent();
            var ajaxRequest = cms_ajax_launch + '?action=saveElement&idx=' + idx + '&eledesc=' + eleDesc;
            var formData = detailsForm.serialize();
            $.get(ajaxRequest, formData, function(theResult) {
                showResult(theResult);
            });
        });
        
        var progress = $('.progress');
        var bar = progress.find('.bar');
        var percent = progress.find('.percent');
        mediaNewBtn.on('click', function(e) {
            e.preventDefault();
            var idx = eleSel.val();
            mediaForm.ajaxSubmit({
                data: { idx: idx  },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                success: function(responseText, statusText) {
                    var responseObj = $.parseJSON(responseText);
                    if(responseObj.code === "0") {
                        eleMediaPreview.attr('src',siteMediaBase + idx + '/' + responseObj.fileelenewname);
                    }
                }
            });
        });

        mediaFileBtn.on('change', function() {
            bar.width(0);
            percent.html('0%');
        });

        tinymce.init({
            selector : "textarea",
            theme : "advanced",
            width : "100%",
            inline : true,
            theme_advanced_disable : "styleselect,outdent,indent,image,cleanup,help,code,removeformat,charmap,visualaid,sub,sup,charmap",
            theme_advanced_buttons1 : "bold,italic,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,formatselect,|,link,unlink,anchor,|,undo,redo",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            theme_advanced_buttons4 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            oninit: function() {
                eleDescObj = tinyMCE.get('txt-ele-desc');
                eleDescObj.setContent('');
            }
        });
        
    });
})();
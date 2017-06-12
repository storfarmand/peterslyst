<?php

function form2PageObj () {

    global $nPage, $allowedTags;

    $formerror = FALSE;

    if (isset($_REQUEST['txt_content_title'])) $nPage->set_content_title(trim($_REQUEST['txt_content_title']));
    else $formerror = TRUE;
    if (isset($_REQUEST['ta_content_text'])) $nPage->set_content_text(strip_tags(trim($_REQUEST['ta_content_text']), $allowedTags));
    else $formerror = TRUE;
    if (isset($_REQUEST['txt_seo_page_title'])) $nPage->set_seo_page_title(trim($_REQUEST['txt_seo_page_title']));
    else $formerror = TRUE;
    if (isset($_REQUEST['txt_seo_keywords'])) $nPage->set_seo_keywords(trim($_REQUEST['txt_seo_keywords']));
    else $formerror = TRUE;
    if (isset($_REQUEST['txt_seo_desc'])) $nPage->set_seo_desc(trim($_REQUEST['txt_seo_desc']));
    else $formerror = TRUE;

    foreach($_REQUEST as $idx=>$val) {
        if(substr($idx, 0, 11) == 'txtPicText_') {
            $picIdx = substr($idx, 11);
            $picText = trim($val);
            $nPage->setPicText($picIdx, $picText);
        }
    }
    
    if($formerror) return FALSE;
    else return TRUE;    

}

?>
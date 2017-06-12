<?php
$pg_idx = "content";
$navbar = "content";
$pg_status = "Indhold";
$pageid = "content";
/*
foreach($_FILES as $idx=>$val) {
    echo $idx.'-'.$val.'<br />';
}
*/
if (!isset($_REQUEST['action'])) {
    switch (TRUE) {
        case (array_key_exists('pbSavePage', $_REQUEST)) :
            $pageid = $_REQUEST['hid_pageid'];
            $nPage = new nPage($pageid);
            if(form2PageObj()) $nPage->save_page();
            $pg_idx = "content";
            $navbar = "content";
            $pg_status = "Rediger indholdsside";
            $action_status = "Indholdet er gemt";
            break;
        case (array_key_exists('fil_content_img_add', $_FILES) && strlen(trim($_FILES['fil_content_img_add']['name'])) > 0) :
                if (is_uploaded_file($_FILES['fil_content_img_add']['tmp_name'])) {
                    $pageid = $_REQUEST['hid_pageid'];
                    $nPage = new nPage($pageid);
                    $new_i_pic = stripslashes($_FILES['fil_content_img_add']['name']);
                    $new_i_pic = str_replace("Å", "aa", $new_i_pic);
                    $new_i_pic = str_replace("Æ", "ae", $new_i_pic);
                    $new_i_pic = str_replace("Ø", "oe", $new_i_pic);
                    $new_i_pic = str_replace("å", "aa", $new_i_pic);
                    $new_i_pic = str_replace("æ", "ae", $new_i_pic);
                    $new_i_pic = str_replace("ø", "oe", $new_i_pic);
                    $new_i_pic = str_replace("-", "", $new_i_pic);
                    $new_i_pic = str_replace("_", "", $new_i_pic);
                    $new_i_pic = str_replace(" ", "", $new_i_pic);
                    $new_i_pic_upload   = $upload_base . $new_i_pic;
                    $unlink_filename = $new_i_pic_upload;
                    if (file_exists($unlink_filename)) {
                        chmod($new_i_pic_upload,0777);
                        unlink($unlink_filename);
                    }
                    $new_i_pic_full = $p_base.$nPage->get_type().'/'.$nPage->get_idx().'/'.$new_i_pic;
                    if (move_uploaded_file($_FILES['fil_content_img_add']['tmp_name'], $new_i_pic_upload)) {
                        chmod($new_i_pic_upload,0777);
                        $resizeObj = new resize($new_i_pic_upload);
                        // Resize image (options: exact, portrait, landscape, auto, crop)
                        $resizeObj->resizeImage(300, 150);
                        $resizeObj->saveImage($new_i_pic_full, 100);
                        $nPage->addContentImg($new_i_pic);
                        $nPage->save_page();
                        unlink($new_i_pic_upload);
                    }
                }
                $pg_idx = "contentEdit";
                $navbar = "content";
                $pg_status = "Rediger indholdsside";
                $action_status = "Billedet blev tilf&oslash;jet";
            break;
        case (array_key_exists('pb_add_sub', $_REQUEST)) :
            if(isset($_REQUEST['hid_main_id'])) $mainid = $_REQUEST['hid_main_id'];
            else die('Error');//invalid logic here
            $newSubText=$_REQUEST['txt_add_sub'];
            $mainMenuObj = new menu_item($mainid);
            $mainPos = $mainMenuObj->get_main();
            $newMenuItem = new menu_item();
            $newMenuItem->set_text($newSubText);
            $newMenuItem->save_menu();
            $newMenuSub = new menu_disp();
            $newMenuSub->create_new($mainPos, $newMenuItem->get_id());
            $menu_item = new menu_item($mainid);
            $pg_idx = "menuedit";
            $navbar = "content";
            $pg_status = "Rediger indholdsside";
            $action_status = "Ny indholdsside er klar";
            break;
        default :
            $column_count = 3;
    }
}
else {
    $action = $_REQUEST['action'];
    switch ($action) {
        case "delItem" :
            $itemIdx = $_REQUEST['itemIdx'];
            $item = new part($itemIdx);
            $item->delete();
            $pg_idx = "spareparts";
            $navbar = "spareparts";
            $pg_status = "Rediger reservedele";
            $action_status = "Vare blev slettet";
            break;
        case "delPic" :
            $pageid = $_REQUEST['pageId'];
            $picId = $_REQUEST['picId'];
            $nPage = new nPage($pageid);
            $nPage->removeImg($picId);
            $pg_idx = "contentEdit";
            $navbar = "content";
            $pg_status = "Redigere forside";
            $action_status = "Billedet blev slettet";
            break;
        case "vcontent" :
            $pg_idx = "content";
            $navbar = "content";
            $pg_status = "Indhold";
            break;
        case "vgallery" :
            $pg_idx = "gallery";
            $navbar = "gallery";
            $pg_status = "Galleri";
            break;
        case "vbizinfo" :
            $pg_idx = "bizinfo";
            $navbar = "bizinfo";
            $pg_status = "Firmaoplysninger";
            break;
        case "logout" :
            session_unset();
            session_destroy();
            session_start();
            $location = $cms_launch;
            break;
        default :
            $pg_idx = "content";
            $navbar = "content";
            $pg_status = "Indhold";
    }
}

if(isset($location)) {
    header("Location: $location");
    exit;
}
?>
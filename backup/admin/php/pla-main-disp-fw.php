<?php

switch ($pg_idx) {
    case "content" :
        require('php/pla-content.php');
        break;
    case "gallery" :
        require('php/pla-gallery.php');
        break;
    case "bizinfo" :
        require('php/pla-bizinfo.php');
        break;
    default :
        require('php/pla-content.php');
}

foreach($_REQUEST as $idx=>$val) {
}

?>
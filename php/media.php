<?php

    switch ($pageRequested) {
        case "udvalg":
//            $mediaObj = new media("udvalg");
            include 'php/static-content/udvalg.php';
            break;
        case "udlejning":
//            $mediaObj = new media("udlejning");
            include 'php/static-content/udlejning.php';
            break;
        default:
//            $mediaObj = new media("udvalg");
            include 'php/static-content/udvalg.php';
    }

?>

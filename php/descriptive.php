<?php

    switch ($pageRequested) {
        case "historie":
//            $mediaObj = new media("udvalg");
            include 'php/static-content/historie.php';
            break;
        case "om":
//            $mediaObj = new media("udlejning");
            include 'php/static-content/om.php';
            break;
        case "vikarservice":
//            $mediaObj = new media("udlejning");
            include 'php/static-content/vikarservice.php';
            break;
        case "campingvogn":
//            $mediaObj = new media("campingvogn");
            include 'php/static-content/campingvogn.php';
            break;
        default:
//            $mediaObj = new media("udvalg");
            include 'php/static-content/historie.php';
    }

?>

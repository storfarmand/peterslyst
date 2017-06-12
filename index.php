<?php ini_set('session.gc_probability',1); ?>
<?php ini_set('session.gc_divisor',1); ?>
<?php
$pageRequested = strlen(ltrim($_SERVER['REQUEST_URI'], "/")) > 0 ? ltrim($_SERVER['REQUEST_URI'], "/") : "forside";

$templateMappings = Array(
    "media"=> Array(
        "udlejning", "udvalg"
    )
  , "descriptive"=> Array(
        "historie", "om", "vikarservice", "campingvogn"
    )
  , "contact"=> Array(
        "kontakt"
    )
);

$currentTemplate = "";

foreach($templateMappings as $tIdx=>$tVal) {
    foreach($tVal as $pIdx=>$pVal) {
        if ($pageRequested == $pVal) {
            $currentTemplate = $tIdx;
            break;
        }
    }
}

//Site configuration
require("site-config.php");
require("php/pl-db-connect.php");
require("php/pl-functions.php");

//Object definitions
require("php/classes/main.class.php");
require("php/classes/media.class.php");
require("php/classes/gridcontainer.class.php");
require("php/classes/gridelement.class.php");
require("php/classes/blackboard.class.php");
require("php/classes/rental.class.php");
require("php/classes/service.class.php");
require('php/classes/class.smtp.php');
require('php/classes/phpmailer.class.php');

$main = new main();
?>
<!DOCTYPE html>
<html lang="da">

<?php require 'php/head.php'; ?>

    <body class="container page-<?php echo strlen($pageRequested) > 0 ? $pageRequested : "default"; ?> template-<?php echo strlen($currentTemplate) > 0 ? $currentTemplate : "default"; ?> ">
        <div class="site-wrapper">
<?php require 'php/topnav.php'; ?>
        
<?php

switch ($currentTemplate) {
    case "media":
        require 'php/media.php';
        break;
    case "descriptive":
        require 'php/descriptive.php';
        break;
    case "contact":
        require 'php/contact.php';
        break;
    default:
        require 'php/home.php';
}

?>
        
<?php require 'php/footer.php'; ?>
<?php require 'php/jsbin.php'; ?>
        </div>
    </body>
</html> 
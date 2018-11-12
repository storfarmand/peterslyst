<?php
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);

$apiRequested = strlen(ltrim($_SERVER['REQUEST_URI'], "/api/v1/")) > 0 ? ltrim($_SERVER['REQUEST_URI'], "/api/v1/") : "root";

//Site configuration
require("../../site-config.php");
require("../../php/pl-db-connect.php");
require("../../royalfireworks/php/rf-functions.php");

$catalog = getCatalog();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($catalog);

?>

<?php
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);

$apiRequested = strlen(ltrim($_SERVER['REQUEST_URI'], "/api/v1/")) > 0 ? ltrim($_SERVER['REQUEST_URI'], "/api/v1/") : "root";

//Site configuration
require("../../site-config.php");
require("../../php/pl-db-connect.php");
require("../../royalfireworks/php/rf-functions.php");

$catalog = json_encode(getCatalog());
$value = array("first_name" => "John", "last_name" => "Hummel", "age" => 53);

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/json");
echo json_encode($value);

?>

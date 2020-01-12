<?php
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);

function currentUrl($server){
    //Figure out whether we are using http or https.
    $http = 'http';
    //If HTTPS is present in our $_SERVER array, the URL should
    //start with https:// instead of http://
    if(isset($server['HTTPS'])){
        $http = 'https';
    }
    //Get the HTTP_HOST.
    $host = $server['HTTP_HOST'];
    //Get the REQUEST_URI. i.e. The Uniform Resource Identifier.
    $requestUri = $server['REQUEST_URI'];
    //Finally, construct the full URL.
    //Use the function htmlentities to prevent XSS attacks.
    return $http . '://' . htmlentities($host) . '/' . htmlentities($requestUri);
}
 
$url = currentUrl($_SERVER);
$qs = parse_url($url, PHP_URL_QUERY);

require("../../site-config.php");
require("../../php/pl-db-connect.php");
require("../../royalfireworks/php/rf-functions.php");

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Access-Control-Allow-Origin: *");
switch ($qs) {
    case "getCatalog":
        $catalog = getCatalog();
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($catalog);
        break;
    case "submitOrder":
        $request_body = file_get_contents('php://input');
        if (strlen($request_body) === 0) {
            $resp = '{"response": "emptyContent"}';
            echo json_encode($resp);
        } else {
            $json = json_decode($request_body);
            ConfirmOrder($json);
            header("Content-Type: application/json; charset=UTF-8");
            $resp = '{"response": "success"}';
            echo json_encode($resp);
        }
        break;
    default:
        header("Content-Type: application/json; charset=UTF-8");
        $resp = '{"error": "unknown"}';
        echo json_encode($resp);
}
?>

<?php

require('../site-config.php');

require('classes/jea-product.class.php');
require('jea-db-connect.php');

$allowedPicExt = Array("png","jpg","jpeg","gif");
$allowedPDFExt = Array("pdf");

$type = "unknown";
if (isset($_FILES['filNewPic'])) { $type = "pic"; }
if (isset($_FILES['filNewPDF'])) { $type = "pdf"; }
$prodNum = (isset($_POST['product_num'])) ? (int)$_POST['product_num'] : "none";

if ($type == "unknown" || $prodNum == "none") { $rc = "99"; }
else {
    
    $product = new product($prodNum);
    
    switch ($type) {
        case "pic":
            $tmpname = $_FILES['filNewPic']['tmp_name'];
            $basename = basename($_FILES['filNewPic']['name']);
            $extArr = $allowedPicExt;
            break;
        case "pdf":
            $tmpname = $_FILES['filNewPDF']['tmp_name'];
            $basename = basename($_FILES['filNewPDF']['name']);
            $extArr = $allowedPDFExt;
            break;
    }

    $uploaddir = $upload_base;
    $uploadfile = $uploaddir . $basename;
    $uploadext = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));

    if(!in_array($uploadext, $extArr)) {
        echo
        "{" .
        "\"code\": \"".($rc = 30)."\"".
        "," . "\"uploadext\": \"".$uploadext."\"".
        "}";
    return; }
    
    $rc = (move_uploaded_file($tmpname, $uploadfile)) ? 0 : 99;

    $newProductFileName = $prodNum . "." . $uploadext;
    $newProductFile = $fs_product_base . $newProductFileName;
    if (copy($uploadfile, $newProductFile)) {
        $product->updateMedia($type, $newProductFileName);
        unlink($uploadFile);
    }
    
}

$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if (!$xhr) echo '<textarea>';
echo "{";
echo "\"code\": \"$rc\"";
echo ", " . "\"type\": \"$type\"";
echo ", " . "\"tmpname\": \"$tmpname\"";
echo ", " . "\"basename\": \"$basename\"";
echo ", " . "\"uploadfile\": \"$uploadfile\"";
echo ", " . "\"prodnum\": \"$prodNum\"";
echo ", " . "\"newproductfile\": \"$newProductFile\"";
echo "}";
if (!$xhr) echo '</textarea>';

?>

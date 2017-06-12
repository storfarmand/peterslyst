<?php

require('../site-config.php');

require('jea-db-connect.php');

$allowedPicExt = Array("png","jpg","jpeg","gif");
$allowedPDFExt = Array("pdf");

$type = "unknown";
if (isset($_FILES['filNewPic'])) { $type = "pic"; }
if (isset($_FILES['filNewPDF'])) { $type = "pdf"; }

if ($type == "unknown") { $rc = "99"; }
else {
    
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

    $newCampaignFileName = "kampagne." . $uploadext;
    $newCampaignFile = $fs_campaign_base . $newCampaignFileName;
    if (copy($uploadfile, $newCampaignFile)) {
        if ($uploadext != "pdf") {
            $camU = "update jes_campaigns set c_pic=\"$newCampaignFileName\" where c_id=1";
            $camRe = $db->query($camU);
        }
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

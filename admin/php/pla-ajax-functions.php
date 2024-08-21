<?php

require('../../site-config.php');

require('classes/pla-image-resize.class.php');

require('classes/pla-product.class.php');
require('classes/pla-brand.class.php');
require('classes/pla-cat.class.php');
require('classes/pla-item.class.php');
require('pla-db-connect.php');

$response = $_REQUEST['action'];

if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {

/***** START - Product Handling *****/        
        
        case "getElement" :
            $GEid = $_REQUEST["GEid"];
            $GEDetail = array();
            $GEDetail["GEid"] = $GEid;
            $GEQ = "
                    SELECT * FROM gridelements
                    WHERE name=\"$GEid\"
                    ";         
            $GERe = $db->query($GEQ);
            if(!$GERe) { die("Fatal error retrieving grid element details, SQL: ". $GEQ); }
            $GERo = $GERe->fetch_object();
            $GEDetail["title"]  = $GERo->title;
            $GEDetail["desc"]  = $GERo->desc;
            $GEDetail["img"]   = $GERo->img;
            $GEDetail["containeridx"]   = $GERo->containeridx;
            $GEDetail["location"]   = $GERo->location;
            $GEDetail["size"]   = $GERo->size;
            $GEDetail["decorations"]   = $GERo->decorations;
            $GEDetail["footer"]   = $GERo->footer;
            $response =  json_encode($GEDetail);
            break;

        case "saveGE" :
            $GEid = $_REQUEST["GEid"];
            $title = addslashes($_REQUEST["title"]);
            $desc = addslashes($_REQUEST["desc"]);
            $GEU = "
                    UPDATE gridelements ge
                        SET ge.title='$title', ge.desc='$desc'
                        WHERE ge.name='$GEid';
                    ";

            $db->query($GEU);
            if(!$db) {
                echo "Fejl saving product info: $GEU";
                exit;
            }
            $response = "Indholdet er gemt";
            break;
        
        case "newProduct" :
            $p_id = -1;
            $product = new product($p_id);
            $p_model = $_REQUEST["p_model"];
            $product->setModel($p_model);
            $product->store();
            $p_id = $product->getId();
            $productDetail = array();
            $productDetail["p_id"] = $p_id;
            $prodQ = "
                    SELECT * FROM jes_products
                    WHERE p_id=$p_id
                    ";
            $prodRe = $db->query($prodQ);
            if(!$prodRe) { die("Fatal error retrieving PICs, SQL: ". $prodQ); }
            $prodRo = $prodRe->fetch_object();
            $productDetail["p_model"]  = $prodRo->p_model;
            $response =  json_encode($productDetail);
            break;
        
        case "delProduct" :
            $p_id = $_REQUEST["p_id"];
            $productDetail = array();
            $productDetail["p_id"] = $p_id;
            $prodQ = "
                    SELECT * FROM jes_products
                    WHERE p_id=$p_id
                    ";
            $prodRe = $db->query($prodQ);
            if(!$prodRe) { die("Fatal error retrieving PICs, SQL: ". $prodQ); }
            $prodRo = $prodRe->fetch_object();
            $productDetail["p_model"]  = $prodRo->p_model;
            $productDetail["p_title"]  = $prodRo->p_title;
            $productDetail["p_text"]   = $prodRo->p_text;
            $productDetail["p_pic"]    = $prodRo->p_pic;
            $productDetail["p_pdf"]    = $prodRo->p_pdf;
            $productDetail["p_active"] = $prodRo->p_active;
            $response =  json_encode($productDetail);
            $product = new product($p_id);
            $product->delete();
            break;

/***** END - Product Handling *****/        
        
/***** START - Campaing Handling *****/        
        
        case "getCampaign" :
            $campaignDetail = array();
            $campaignDetail["c_id"] = 1;
            $camQ = "
                    SELECT * FROM jes_campaigns
                    WHERE c_id=1
                    ";
            $camRe = $db->query($camQ);
            if(!$camRe) { die("Fatal error retrieving PICs, SQL: ". $camQ); }
            $camRo = $camRe->fetch_object();
            $campaignDetail["c_pic"]    = $camRo->c_pic;
            $campaignDetail["c_pdf"]    = $camRo->c_pdf;
            $campaignDetail["c_active"] = $camRo->c_active;
            $response =  json_encode($campaignDetail);
            break;

/***** END - Campaign Handling *****/        
        
/***** START - Business Handling *****/        
        
        case "saveFInfo" :
            $bz_name    = addslashes($_REQUEST["bz_name"]);
            $bz_address = addslashes($_REQUEST["bz_address"]);
            $bz_city = addslashes($_REQUEST["bz_city"]);
            $bz_zip = addslashes($_REQUEST["bz_zip"]);
            $bz_tele    = addslashes($_REQUEST["bz_tele"]);
            $bz_email   = addslashes($_REQUEST["bz_email"]);
            $bz_cvr   = addslashes($_REQUEST["bz_cvr"]);
            $bzU = "
                    UPDATE main
                        SET biz_name='$bz_name', biz_address='$bz_address', biz_city='$bz_city', biz_zip='$bz_zip', biz_tele='$bz_tele', biz_email='$bz_email', biz_cvr='$bz_cvr'
                    ";
            $db->query($bzU);
            if(!$db) {
                echo "Fejl saving product info: $bzU";
                exit;
            }
            $response = "Indholdet er gemt";
            break;
            
/***** END - Business Handling *****/
            
            
            
/***** START - Item Handling *****/

        case "getItem" :
            $i_id = $_REQUEST["i_id"];
            $itemDetail = array();
            $itemDetail["i_id"] = $i_id;
            $itemQ = "
                    SELECT * FROM jes_items
                    WHERE i_id=$i_id
                    ";
            $itemRe = $db->query($itemQ);
            if(!$itemRe) { die("Fatal error retrieving item detail, SQL: ". $itemQ); }
            $itemRo = $itemRe->fetch_object();
            $itemDetail["i_title"]  = $itemRo->i_title;
            $itemDetail["i_text"]  = $itemRo->i_text;
            $itemDetail["i_pdf"]  = $itemRo->i_pdf;
            $itemDetail["i_pic"]  = $itemRo->i_pic;
            $itemDetail["i_price"]  = $itemRo->i_price;
            $itemDetail["i_qty"]  = $itemRo->i_qty;
            $itemDetail["i_active"]  = $itemRo->i_active;
            $itemDetail["i_cat2"]  = $itemRo->i_cat;
            if($itemDetail["i_cat2"] > 0) {
                $mainCat = new cat($itemRo->i_cat);
                $itemDetail["i_cat1"]  = $mainCat->getOwner();
            } else {
                $itemDetail["i_cat1"] = -1;
            }
            $itemDetail["i_brand"]  = $itemRo->i_brand;
            $response =  json_encode($itemDetail);
            break;

            
        case "newItem" :
            $i_id = -1;
            $item = new item($i_id);
            $i_title = $_REQUEST["i_title"];
            $item->setTitle($i_title);
            $item->store();
            $itemDetail = array();
            $itemDetail["i_id"] = $item->getId();
            $itemDetail["i_title"] = $item->getTitle();
            $response =  json_encode($itemDetail);
            break;
        
        case "saveItem" :
            $i_id = $_REQUEST["i_id"];
            $item = new item($i_id);
            $item->setTitle(addslashes($_REQUEST["i_title"]));
            $item->setText(addslashes($_REQUEST["i_desc"]));
            $item->setPrice($_REQUEST["i_price"]);
            $item->setQty($_REQUEST["i_qty"]);
            $item->setActive($_REQUEST["i_active"]);
            $item->setCat($_REQUEST["i_cat"]);
            $item->setBrand($_REQUEST["i_brand"]);
            $item->store();
            $response = "Varen er gemt";
            break;
        
        case "getCat2" :
            $cat1_idx = $_REQUEST["cat1_idx"];
            $cat2values = array();
            $cat2Q = "
                    SELECT * FROM jes_cats
                    WHERE cat_owner=$cat1_idx
                    ORDER BY cat_name;
                    ";
            $cat2Re = $db->query($cat2Q);
            if(!$cat2Re) { die("Fatal error retrieving cat2 list, SQL: ". $cat2Q); }
            while($cat2Ro = $cat2Re->fetch_object()) {
                $cat2values[$cat2Ro->cat_idx] = $cat2Ro->cat_name;
            }
            $response =  json_encode($cat2values);
            break;

        case "swapItemPic" :
            $uploaded_file_name = basename($_FILES['fil_item_picture']['name']);
            $uploaddir = $upload_base;
            $uploadfile = $uploaddir . $uploaded_file_name;
            if (!move_uploaded_file($_FILES['fil_item_picture']['tmp_name'], $uploadfile)) {
                $response = "Possible file upload attack!";
                echo $response;
                return;
            }
            $i_id = $_REQUEST["i_id"];
            $destination_folder = $fs_items_base . $i_id . "/";
            $destination = $destination_folder . $uploaded_file_name;
            if(!is_dir($destination_folder)) mkdir($destination_folder, 0777);
            chmod($destination_folder, 0777);
            copy($uploadfile, $destination);
            chmod($destination, 0777);
            $resizeObj = new resize($uploadfile);
            // Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj->resizeImage(150, 300, "portrait");
            $resizeObj->saveImage($destination, 100);
            $itemDetail = array();
            $item = new item($i_id);
            $item->setPic($uploaded_file_name);
            $item->store();
            $itemDetail["i_id"] = $item->getId();
            $itemDetail["i_text"] = $item->getText();
            $itemDetail["i_logo"] = $item->getPic();
//            $brand->delete();
            $response =  json_encode($itemDetail);
            break;

        case "swapItemPDF" :
            $uploaded_file_name = basename($_FILES['fil_item_pdf']['name']);
            $uploaddir = $upload_base;
            $uploadfile = $uploaddir . $uploaded_file_name;
            if (!move_uploaded_file($_FILES['fil_item_pdf']['tmp_name'], $uploadfile)) {
                $response = "Possible file upload attack!";
                echo $response;
                return;
            }
            $i_id = $_REQUEST["i_id"];
            $destination_folder = $fs_items_base . $i_id . "/";
            $destination = $destination_folder . $uploaded_file_name;
            if(!is_dir($destination_folder)) mkdir($destination_folder, 0777);
            chmod($destination_folder, 0777);
            copy($uploadfile, $destination);
            chmod($destination, 0777);
            $itemDetail = array();
            $item = new item($i_id);
            $item->setPDF($uploaded_file_name);
            $item->store();
            $itemDetail["i_id"] = $item->getId();
            $itemDetail["i_text"] = $item->getText();
            $itemDetail["i_pdf"] = $item->getPDF();
//            $brand->delete();
            $response =  json_encode($itemDetail);
            break;

/***** END - Item Handling *****/


            
            
/***** START - Brand Handling *****/        
       
        case "getBrand" :
            $b_idx = $_REQUEST["b_idx"];
            $brandDetail = array();
            $brandDetail["b_idx"] = $b_idx;
            $brandQ = "
                    SELECT * FROM jes_brands
                    WHERE b_idx=$b_idx
                    ";
            $brandRe = $db->query($brandQ);
            if(!$brandRe) { die("Fatal error retrieving brand detail, SQL: ". $brandQ); }
            $brandRo = $brandRe->fetch_object();
            $brandDetail["b_text"]  = $brandRo->b_text;
            $brandDetail["b_logo"]  = $brandRo->b_logo;
            $response =  json_encode($brandDetail);
            break;

        case "saveBrand" :
            $b_idx = $_REQUEST["b_idx"];
            $b_text = addslashes($_REQUEST["b_text"]);
            $brandU = "
                    UPDATE jes_brands
                        SET b_text='$b_text'
                        WHERE b_idx=$b_idx;
                    ";
            $db->query($brandU);
            if(!$db) {
                echo "Fejl saving brand info: $brandU";
                exit;
            }
            $response = "Indholdet er gemt";
            break;
        
        case "newBrand" :
            $b_idx = -1;
            $brand = new brand($b_idx);
            $b_text = $_REQUEST["b_text"];
            $brand->setText($b_text);
            $brand->store();
            $brandDetail = array();
            $brandDetail["b_idx"] = $brand->getIdx();
            $brandDetail["b_text"] = $brand->getText();
            $brandDetail["b_logo"] = $brand->getLogo();
            $response =  json_encode($brandDetail);
            break;
        
        case "delBrand" :
            $b_idx = $_REQUEST["b_idx"];
            $brandDetail = array();
            $brand = new brand($b_idx);
            $brandDetail["b_idx"] = $brand->getIdx();
            $brandDetail["b_text"] = $brand->getText();
            $brandDetail["b_logo"] = $brand->getLogo();
            $brand->delete();
            $response =  json_encode($brandDetail);
            break;

        case "swapLogo" :
            $uploaded_file_name = basename($_FILES['fil_logo']['name']);
            $uploaddir = $upload_base;
            $uploadfile = $uploaddir . $uploaded_file_name;
            if (!move_uploaded_file($_FILES['fil_logo']['tmp_name'], $uploadfile)) {
                $response = "Possible file upload attack!";
                echo $response;
                return;
            }
            $b_idx = $_REQUEST["b_idx"];
            $destination_folder = $fs_brands_base . $b_idx . "/";
            $destination = $destination_folder . $uploaded_file_name;
            if(!is_dir($destination_folder)) mkdir($destination_folder, 0777);
            chmod($destination_folder, 0777);
            copy($uploadfile, $destination);
            chmod($destination, 0777);
            $resizeObj = new resize($uploadfile);
            // Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj->resizeImage(100, 50, "landscape");
            $resizeObj->saveImage($destination, 100);
            $brandDetail = array();
            $brand = new brand($b_idx);
            $brand->setLogo($uploaded_file_name);
            $brand->store();
            $brandDetail["b_idx"] = $brand->getIdx();
            $brandDetail["b_text"] = $brand->getText();
            $brandDetail["b_logo"] = $brand->getLogo();
            $response =  json_encode($brandDetail);
            break;

/***** START - Brand Handling *****/        

            
/***** START - Category Handling *****/        
       
        case "getSubCats" :
            $c_idx = $_REQUEST["c_idx"];
            $catDetail = array();
            $catDetail["c_idx"] = $c_idx;
            $catDetail["subCatList"] = array();
            $catQ = "
                    SELECT * FROM jes_cats
                    WHERE cat_owner=$c_idx
                    ORDER BY cat_name
                    ";
            $catRe = $db->query($catQ);
            if(!$catRe) { die("Fatal error retrieving subCat list, SQL: ". $catQ); }
            while ($catRo = $catRe->fetch_object()) {
                $catDetail["subCatList"][$catRo->cat_idx]   = $catRo->cat_name;
            }
            $response =  json_encode($catDetail);
            break;

        case "saveCat" :
            $cat_idx = $_REQUEST["cat_idx"];
            $cat_name = addslashes($_REQUEST["cat_name"]);
            $catU = "
                    UPDATE jes_cats
                        SET cat_name='$cat_name'
                        WHERE cat_idx=$cat_idx;
                    ";
            $db->query($catU);
            if(!$db) {
                echo "Fejl saving brand info: $catU";
                exit;
            }
            $response = "Kategoriteksten er gemt";
            break;
        
        case "newCat" :
            $cat_idx = -1;
            $cat = new cat($cat_idx);
            $cat_name = $_REQUEST["cat_name"];
            $cat_owner = $_REQUEST["cat_owner"];
            $cat->setName($cat_name);
            $cat->setOwner($cat_owner);
            $cat->store();
            $catDetail = array();
            $catDetail["cat_idx"] = $cat->getIdx();
            $catDetail["cat_name"] = $cat->getName();
            $response =  json_encode($catDetail);
            break;
        
        case "delCat" :
            $cat_idx = $_REQUEST["cat_idx"];
            $catDetail = array();
            $cat = new cat($cat_idx);
            $catDetail["cat_idx"] = $cat->getIdx();
            $catDetail["cat_name"] = $cat->getName();
            $cat->delete();
            $response =  json_encode($catDetail);
            break;

/***** START - Category Handling *****/        

    }
}

echo $response;
?>

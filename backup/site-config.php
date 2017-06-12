<?php

// CMS System - Site Configuration
$site_mode = 'P'; // P - Production, T - Test

if ($site_mode == 'P') {
    error_reporting(0);
    $site_hostname = 'www.peterslyst.com';
    //Where does the contact form get sent to?
    $mail_contact = "support@the-best-designs.dk";
    $site_fs_base = "/var/www/peterslyst.com/public_html/";
    $db_host = 'mysql31.unoeuro.com';
    $db_user = 'peterslyst_com';
    $db_pass = 'op7913';
    $db_database = 'peterslyst_com_db';
    $mailHost = "smtp.unoeuro.com";
    $mailPort = 25;
    $mailAuth = false;
    $mailUser = "";
    $mailPass = "";
    $mailDebug = 0;
    $mailBCC = array("chefen@peterslyst.com", "storfarmand@gmail.com");
} else {
    error_reporting(E_ALL);
    $site_hostname = 'localhost';
    //Where does the contact form get sent to?
    $mail_contact = "support@the-best-designs.com";
    $site_fs_base = "/www/peterslyst.com/";
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_database = 'peterslyst_com_db';
    $mailHost = "asmtp.unoeuro.com";
    $mailPort = 587;
    $mailAuth = true;
    $mailUser = "jhummel@the-best-designs.com";
    $mailPass = "soco2000";
    $mailDebug = 2;
    $mailBCC = array("chefen@peterslyst.com", "storfarmand@gmail.com");
}

//$BasePath = "/";

$site_debug=0;
$site_domain      = "peterslyst.com";                       // The domain name of the customer
$site_name        = "Peters Lyst";                          // The business name of the customer
$site_base        = "http://$site_hostname/";               // Base URL to the homepage
$site_launch      = "http://$site_hostname/index.php";      // URL to launch the homepage
$site_form_name   = "frm_jes";                              // Name of the HTML form
$site_form_action = "http://$site_hostname/index.php";      // Action to take when submitting the HTML form
$site_timeout = 900;                                        // Format: "ssss" The number of seconds for a user to be timed out

$cms_style = "style.css";                                   // The relative path to the CMS Style Sheet
$cms_logo = "gfx/tbd_logo.gif";                             // The relative path to the Logo file that will appear on the Login Screen
$cms_title = "The Best Designs CMS Administration";         // What will appear in the browser Title Bar
$cms_support_name = "The Best Designs Support";             // Name of the support team for the CMS system
$cms_support_email = "support@the-best-designs.com";        // Email of the support team for the CMS system
$cms_logo_action = "http://www.the-best-designs.com/";      // URL Action to take when clicking on the The Best Designs logo
$cms_launch = "http://$site_hostname/admin/";               // URL to launch the CMS System
$cms_ajax_launch = "http://$site_hostname/admin/php/pla-ajax-functions.php";  // URL to launch the CMS AJAX
$cms_file_upload = "http://$site_hostname/admin/php/pla-upload.php";  // URL for generic uploads
$cms_tbd_launch = "http://www.the-best-designs.com/cms/";   // URL to launch the TBD CMS System

//Catalogue locations
$site_relative_foldere_base   = "_foldere/";
$site_foldere_base            = "http://$site_hostname/" . $site_relative_foldere_base;
$site_relative_product_base   = "_products/";
$site_product_base            = "http://$site_hostname/" . $site_relative_product_base;
$site_relative_campaign_base  = "_kampagne/";
$site_campaign_base           = "http://$site_hostname/" . $site_relative_campaign_base;
$site_relative_items_base     = "_items/";
$site_items_base              = "http://$site_hostname/" . $site_relative_items_base;
$site_relative_brands_base    = "_brands/";
$site_brands_base             = "http://$site_hostname/" . $site_relative_brands_base;

$upload_base      = $site_fs_base."uploads/";
$fs_foldere_base  = $site_fs_base . $site_relative_foldere_base;
$fs_product_base  = $site_fs_base . $site_relative_product_base;
$fs_campaign_base = $site_fs_base . $site_relative_campaign_base;
$fs_item_base     = $site_fs_base . $site_relative_items_base;
$fs_brands_base   = $site_fs_base . $site_relative_brands_base;

//Allowed tags from the tinymce editor
$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
$allowedTags.='<li><ol><ul><div><br><ins><del><a>';

?>
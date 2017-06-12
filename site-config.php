<?php

// CMS System - Site Configuration
$site_mode = 'P'; // P - Production, T - Test

if ($site_mode == 'P') {
    error_reporting(0);
    $site_hostname = 'www.peterslyst.com';
    //Where does the contact form get sent to?
    $mail_contact = "chefen@peterslyst.com";
    $site_fs_base = "/var/www/peterslyst.com/public_html/";
    $db_host = 'mysql31.unoeuro.com';
    $db_user = 'peterslyst_com';
    $db_pass = 'op7913';
    $db_database = 'peterslyst_com_db';
    $mailHost = "smtp.unoeuro.com";
    $mailPort = 25;
    $mailAuth = false;
    $mailUser = "kontakt@peterslyst.com";
    $mailPass = "op7913";
    $mailDebug = 0;
    $mailBCC = array("charlotte@hjarl.dk", "storfarmand@gmail.com");
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
    $mailUser = "kontakt@peterslyst.com";
    $mailPass = "op7913";
    $mailDebug = 2;
    $mailBCC = array("charlotte@hjarl.dk", "storfarmand@gmail.com");
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
$site_relative_media_base   = "_media/";
$site_media_base            = "http://$site_hostname/" . $site_relative_media_base;

$upload_base      = $site_fs_base."uploads/";
$fs_media_base    = $site_fs_base . $site_relative_media_base;

//Allowed tags from the tinymce editor
$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
$allowedTags.='<li><ol><ul><div><br><ins><del><a>';

$seo = array(
             "forside"      => array("title" => "Friske grønsager og frugter | Gårdbutik syd for Århus", "desc" => "Peterslyst Gårdbutik sælger smagfulde danske kartofler, jordbær og årstidens grøntsager - direkte fra marken til forbrugeren.",     "keywords" => "gårdbutik, jordbær, kartofler, ærter, græskar, jord til bord, grøntsager, grønsager")
           , "udvalg"       => array("title" => "Kartofler, gulerødder, Ærter, Jordbær  | udvalgte grønsags sorter", "desc" => "Vi har valgt de sorter der passer til vores gode muldjord,  og ud fra bla. smag, udbytte og modtagelighed overfor sygdomme", "keywords" => "ærter, kartofler, gulerødder, jordbær, græskar, arielle kartofler, utrillo ærter ")
           , "udlejning"    => array("title" => "Fræser, motorsav, slåmaskine, stillads | Udlejning af værktøj i Århus området", "desc" => "Spar på budgettet og lej dit værktøj hos Peterslyst. Vi udlejer havefræser, slåmaskine, mortorsav og stillads", "keywords" => "udlejning, værktøj, kram, havefræser, fræser, slåmaskine, slå maskine, stillads, motorsav ")
           , "campingvogn"    => array("title" => "Udlejning af campingvogne i Århus området", "desc" => "Nyd en dejlig familieferie i en af vores fuldt udstyrede campingvogne", "keywords" => "udlejning, campingvogn, familieferie, Knaus, Hobby Prestige ")
	   , "kontakt"      => array("title" => "Kontakt Peterslyst Gårdbutik", "desc" => "Kontakt Peterslyst Gårdbutik for spørgsmål vedr. vikarservice, udlejning af værktøj eller bestilling af grønsager og frugter", "keywords" => "bestil grønsager, bestil vikar, reserver værktøj, kontakt, gårdbutik Århus Syd, Gårdbutik Østjylland")
           , "om"           => array("title" => "Gårdbutikken med de gode råvarer | Peterslyst Gårdbutik",   "desc" => "Passion for de gode danske grønsager og frugter, og ikke mindst lokale råvarer.",   "keywords" => "Peterslyst gårdbutik, Gårdbutik, lokale råvarer, kartofler, tidlige kartofler, årstidernes grønsager ")
           , "historie"     => array("title" => "Peterslyst historie | Vores planer med Gårdbutikken",    "desc" => "Bygningerne er fra 1880 så nye bygninger er nødvendige for etablering af Gårdbutikken Peterslyst",    "keywords" => "Gårdbutik, Peterslyst, lokale grønsager")
           , "vikarservice" => array("title" => "Palles vikarservice i Østjylland | Landbrugsvikar, træfældning, håndmand og handyman",    "desc" => "Palles kompetencer er mange, og han kan lejes på fleksible vilkår, både på dags/time basis eller for en længere periode",    "keywords" => "landbrugsvikar, handyman, markarbejde, svinebesætning")
    );

?>
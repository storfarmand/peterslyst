<?php
require('..//site-config.php');

require('php/pla-db-connect.php');
require('php/classes/pla-image-resize.class.php');
require('php/pla-functions.php');

session_start();

require('php/pla-seq-check.php');

require('php/pla-pre-proc-fw.php');

require('php/pla-head.php');
?>

<!-- HTML BODY STARTS HERE -->
<body class="container">

<?php
require('php/pla-navbar.php');
?>

<!-- START CENTER CONTENT -->
<div id="center_container" class="row">

<?php
require('php/pla-infobar.php');
require('php/pla-main-disp-fw.php');
require('php/pla-footer.php');
?>

</div>
<!-- END CENTER CONTENT -->

<?php
require('php/pla-jsbin.php');
?>

</body>
</html>
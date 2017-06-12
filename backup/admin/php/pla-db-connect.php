<?php
$db = new mysqli($db_host, $db_user, $db_pass, $db_database);

/* check connection */
if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
    exit();
}

/* change character set to utf8 */
if (!$db->set_charset("utf8")) {
    die($db->error);
}
?>
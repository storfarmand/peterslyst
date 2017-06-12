<?php
    
if (!isset($_SESSION['seq_status'])) {
  $_SESSION['seq_status'] = "NG";
}

if (isset($_REQUEST['hid_action']) && $_REQUEST['hid_action'] == "fromtbdcms") {
  if (isset($_REQUEST['hid_value1']) && isset($_REQUEST['hid_value2'])) {
    $cms_user      = $_REQUEST['hid_value1'];
    $cms_password  = $_REQUEST['hid_value2'];
    $result = $db->query("SELECT * FROM cms_users WHERE usr_userid=\"".$cms_user."\"");
    if (!$result){
        die($db->error);
    }
    $record = $result->fetch_object();
    $user_password = $record->usr_password;
    if ($user_password == $cms_password) {
      $_SESSION['seq_status']   = "OK";
      $_SESSION['seq_userid']   = $cms_user;
      $_SESSION['seq_password'] = $cms_password;
    }
  }
}

//$_SESSION['seq_status']   = "OK";
//$_SESSION['seq_userid']   = "test";

if ($_SESSION['seq_status'] <> "OK") {
  header("Location:  $cms_tbd_launch");
  ob_end_flush();
}
?>
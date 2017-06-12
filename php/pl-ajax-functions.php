<?php

    require_once("../site-config.php");
    require_once('pl-db-connect.php');
    require_once('pl-functions.php');

    if (!array_key_exists('action', $_REQUEST)) { return; }
    $action = $_REQUEST['action'];
    
    $rc = array(
        'code'    => -1
      , 'msg'     => ''
      , 'details' => array(
          'request' => ''
      )
    );
    
    switch($action) {
        case "signup":
            $name = $_REQUEST["newsname"];
            $email = $_REQUEST["newsemail"];
            $tele = $_REQUEST["newstele"];
            $signupSQL = "insert into newsmembers (email, name, phone, status) values('$email', '$name', '$tele', 'I')";
            $signupRe = $db->query($signupSQL);

            $rc["details"]["request"] = "signup";
            $rc["details"]["name"] = $name;
            $rc["details"]["email"] = $email;
            $rc["details"]["tele"] = $tele;

            if ($signupRe) {
                $rc["code"] = 0;
                $rc["msg"] = "News signup successful";
            } else {
                $rc["code"] = $db->errno;
                $rc["msg"] = $db->error;

            }
            break;
    }

    echo json_encode($rc);


?>
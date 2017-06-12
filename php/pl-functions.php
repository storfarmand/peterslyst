<?php

function getContent($name) {
    global $db;
    $gridIQ = "select * from gridelements where name=\"$name\"";
    $gridIRe = $db->query($gridIQ);
    if (!$gridIRe){
        die($db->error);
    }
    $gridIRo = $gridIRe->fetch_object();
    return $gridIRo;
}


function Email($to, $subject, $msg) {
    
    global $mailHost, $mailPort, $mailAuth, $mailUser, $mailPass, $mailDebug, $mailBCC;
    
    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    //Tell PHPMailer to use SMTP
    $mail->IsSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug  = $mailDebug;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host       = $mailHost;
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port       = $mailPort;
    //Whether to use SMTP authentication
    $mail->SMTPAuth   = $mailAuth;
    //Username to use for SMTP authentication
    $mail->Username   = $mailUser;
    //Password to use for SMTP authentication
    $mail->Password   = $mailPass;
    //Set who the message is to be sent from
    $mail->SetFrom('kontakt@peterslyst.com', 'Peterslyst Gårdbutik');
    //Set an alternative reply-to address
    //$mail->AddReplyTo('replyto@example.com','First Last');
    //Set who the message is to be sent to
    $mail->AddAddress($to);
    //Add BCC addresses
    foreach($mailBCC as $emailAddress) {
        $mail->AddBCC($emailAddress);
    }
    //Set the subject line
    $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
    $mail->MsgHTML($msg);
    //Replace the plain text body with one created manually
    $mail->AltBody = $msg;
    //Attach an image file
    //$mail->AddAttachment('images/phpmailer_mini.gif');

    //Send the message, check for errors
    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }
    
}

?>

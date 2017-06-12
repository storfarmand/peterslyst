<?php
if (array_key_exists("conSubmit", $_POST)) {

    $notBody = "<div style=\"font-family: Calibri, Arial, Helvetica, sans-serif;\">";
    $notBody .= "Anmodning detaljer:<br>";
    $notBody .= "<br>";
    $notBody .= "Navn: ".$_POST["conName"]."<br>";
    $notBody .= "Adresse: ".$_POST["conAddress"]."<br>";
    $notBody .= "Post nr: ".$_POST["conZip"]."<br>";
    $notBody .= "By: ".$_POST["conCity"]."<br>";
    $notBody .= "Tel nr: ".$_POST["conTele"]."<br>";
    $notBody .= "Email: <a href=\"mailto:".$_POST["conEmail"]."\">".$_POST["conEmail"]."</a><br>";
    $notBody .= "Besked: ".$_POST["conMessage"]."<br>";
    
    $to = $mail_contact;
    $mySubject = "Gårdbutikken Peterslyst - Kontakt anmodning";
    $myMessage = $notBody;

    Email($to, $mySubject, $myMessage);
?>
<p class="contact confirm">Tak for besked</p>
<?php
} else {
?>
<form class="contact form-horizontal" role="form" action="kontakt" method="post">
  <div class="form-group">
    <label for="conName" class="col-sm-2 control-label">Navn</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="conName" id="conName" placeholder="Navn">
    </div>
  </div>
  <div class="form-group">
    <label for="conAddress" class="col-sm-2 control-label">Adresse</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="conAddress" id="conAddress" placeholder="Adresse">
    </div>
  </div>
  <div class="form-group">
      <label for="conZip" class="col-sm-2 control-label">Post nr</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="conZip" id="conZip" placeholder="Post nr">
    </div>
  </div>
  <div class="form-group">
    <label for="conCity" class="col-sm-2 control-label">By</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="conCity" id="conCity" placeholder="By">
    </div>
  </div>
  <div class="form-group">
    <label for="conTele" class="col-sm-2 control-label">Tel nr.</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="conTele" id="conTele" placeholder="Tel nr">
    </div>
  </div>
  <div class="form-group">
    <label for="conEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-8">
      <input type="email" class="form-control" name="conEmail" id="conEmail" placeholder="Email1">
    </div>
  </div>
  <div class="form-group">
    <label for="conMessage" class="col-sm-2 control-label">Besked</label>
    <div class="col-sm-8">
        <textarea class="form-control" rows="3" name="conMessage" id="conMessage"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
      <button name="conSubmit" type="submit" class="btn btn-default">Send</button>
    </div>
  </div>
</form>
<?php } ?>
<?php
    $bzQ = "select * from main";
    $bzRe = $db->query($bzQ);
    $bzRo = $bzRe->fetch_object();
    $biz_name    = $bzRo->biz_name;
    $biz_address = $bzRo->biz_address;
    $biz_city = $bzRo->biz_city;
    $biz_zip = $bzRo->biz_zip;
    $biz_tele    = $bzRo->biz_tele;
    $biz_email   = $bzRo->biz_email;
    $biz_cvr   = $bzRo->biz_cvr;
?>
<div id="bizinfo" class="container">
    <form role=form" id="frm_bizinfo_details" name="frm_bizinfo_details" class="row col-lg-6 col-md-8 col-sm-10 col-xs-12" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="txtFName">Navn</label>
            <input type="input" class="form-control" id="txtFName" placeholder="Firmanavn" value="<?php echo $biz_name; ?>">
        </div>
        <div class="form-group">
            <label for="txtFAddress">Adresse</label>
            <input type="input" class="form-control" id="txtFAddress" placeholder="Adresse" value="<?php echo $biz_address; ?>">
        </div>
        <div class="form-group">
            <label for="txtFCity">By</label>
            <input type="input" class="form-control" id="txtFCity" placeholder="By" value="<?php echo $biz_city; ?>">
        </div>
        <div class="form-group">
            <label for="txtFZip">Post nr</label>
            <input type="input" class="form-control" id="txtFZip" placeholder="Post nr" value="<?php echo $biz_zip; ?>">
        </div>
        <div class="form-group">
            <label for="txtFTele">Tlf nr</label>
            <input type="input" class="form-control" id="txtFTele" placeholder="Tlf nr" value="<?php echo $biz_tele; ?>">
        </div>
        <div class="form-group">
            <label for="txtFEmail">Email</label>
            <input type="input" class="form-control" id="txtFEmail" placeholder="Email" value="<?php echo $biz_email; ?>">
        </div>
        <div class="form-group">
            <label for="txtFCVR">CVR nr.</label>
            <input type="input" class="form-control" id="txtFCVR" placeholder="CVR nr" value="<?php echo $biz_cvr; ?>">
        </div>
        <button type="submit" class="btn btn-primary" id="pbSaveFInfo" name="pbSaveFInfo">Gem ændringer</button>
    </form>
</div>
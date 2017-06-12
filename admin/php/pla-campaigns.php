<?php
    $camQ = "select c_pic, c_pdf from jes_campaigns where c_id=1";
    $camRe = $db->query($camQ);
    $camRo = $camRe->fetch_object();
?>
<div id="campaigns">
    <fieldset id="campaignMedia">
        <legend>Medie</legend>
        <form id="frm_campaign_pic" name="frm_campaign_pic" method="post" enctype="multipart/form-data" action="<?php echo $cms_campaign_upload; ?>">
            <ul>
                <li>Nuværende billed: (215 x 129)<span id="spPicName" class="media-name"></span></li>
                <li id="campaignPicPreview"><img src="<?php echo $site_campaign_base . $camRo->c_pic; ?>" alt="" /></li>
                <li><input id="filNewPic" name="filNewPic" type="file" /></li>
                <li><input id="pbNewPic" name="pbNewPic" type="submit" value="Byt billed"/></li>
            </ul>
        </form>
        <form id="frm_campaign_pdf" name="frm_campaign_pdf" method="post" enctype="multipart/form-data" action="<?php echo $cms_campaign_upload; ?>">
            <ul>
                <li>Nuværende PDF: <span id="spPDFName" class="media-name"></span></li>
                <li id="campaignPDFPreview"></li>
                <li id="pbNewPDF"></li>
                <li><input id="filNewPDF" name="filNewPDF" type="file" /></li>
                <li><input id="pbNewPDF" name="pbNewPDF" type="submit" value="Byt PDF"/></li>
            </ul>
       </form>
        <div class="progress">
            <div class="bar"></div >
            <div class="percent">0%</div >
        </div>
        <div id="status"></div>
    </fieldset>
</div>
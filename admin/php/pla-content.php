<div class="content container">
    <form class="content-details" name="frm_content_details" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Vælg produkt:
        <select id="selPage">
            <option value="-1">&nbsp</option>
    <?php
    /*
        $prodQ = "select p_id, p_model from jes_products order by p_model";
        $prodRe = $db->query($prodQ);
        while ($prodRo = $prodRe->fetch_object()) {
            echo "        <option value=\"".$prodRo->p_id."\">".$prodRo->p_model."</option>\n";
        }
    */
    ?>
        </select>
        <input class="del-page" name="pbDelPage" type="button" value="Slet" class="button" />
        <fieldset class="page-detail">
            <legend>Side indhold</legend>
            <div class="form-group">
                <label for="txtProductModel">Navn</label>
                <input type="input" class="form-control" id="txtProductModel" placeholder="Produkt model" value="">
            </div>
            <ul>
                <li>Side titel</li>
                <li><input name="txtProductModel" type="input" /> <button type="submit" class="btn btn-primary" id="pbNewPage" name="pbNewPage">Tilføj ny</button></li>
            </ul>
            <ul>
                <li>Titel:</li>
                <li><input name="txtProductTitle" type="input" /></li>
            </ul>
            <ul>
                <li>Beskrivelse:</li>
                <li><textarea name="taProductText" /></textarea>
            </ul>
            <ul>
                <li></li>
                <li><input name="cbProductActive" type="checkbox" /> Aktiv</li>
            </ul>
            <button type="submit" class="btn btn-primary" id="pbSaveCInfo" name="pbSaveCInfo">Gem ændringer</button>
        </fieldset>
    </form>

    <fieldset class="page-media">
        <legend>Medie</legend>
        <form class="page-pic" name="frm_product_pic" method="post" enctype="multipart/form-data" action="<?php echo $cms_file_upload; ?>">
            <ul>
                <li>Nuværende billed: <span class="media-name"></span></li>
                <li class="pic-preview"><img src="" alt="" /></li>
                <li><input class="new-pic" name="filNewPic" type="file" /></li>
                <li><input class="new-pic" name="pbNewPic" type="submit" value="Byt billed"/></li>
            </ul>
        </form>
        <div class="progress">
            <div class="bar"></div >
            <div class="percent">0%</div >
        </div>
        <div id="status"></div>
    </fieldset>
</div>
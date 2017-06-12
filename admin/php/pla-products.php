<div id="products">
    <form id="frm_product_details" name="frm_product_details" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Vælg produkt:
        <select id="selProduct">
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
        <input id="pbDelProduct" name="pbDeleProduct" type="button" value="Slet" class="button" />
        <fieldset id="productDetail">
            <legend>Produkt detaljer</legend>
            <ul>
                <li>Model nr:</li>
                <li><input id="txtProductModel" name="txtProductModel" type="input" /> <input id="pbNewProduct" name="pbNewProduct" type="button" value="Tilføj ny" class="button" /></li>
            </ul>
            <ul>
                <li>Titel:</li>
                <li><input id="txtProductTitle" name="txtProductTitle" type="input" /></li>
            </ul>
            <ul>
                <li>Beskrivelse:</li>
                <li><textarea id="taProductText" name="taProductText" /></textarea>
            </ul>
            <ul>
                <li></li>
                <li><input id="cbProductActive" name="cbProductActive" type="checkbox" /> Aktiv</li>
            </ul>
            <ul>
                <li></li>
                <li><input type="submit" id="pbSaveProduct" name="pbSaveProduct" value="Gem ændringer" class="button" /></li>
            </ul>
        </fieldset>
    </form>

    <fieldset id="productMedia">
        <legend>Medie</legend>
        <form id="frm_product_pic" name="frm_product_pic" method="post" enctype="multipart/form-data" action="<?php echo $cms_file_upload; ?>">
            <ul>
                <li>Nuværende billed: <span id="spPicName" class="media-name"></span></li>
                <li id="productPicPreview"><img src="" alt="" /></li>
                <li><input id="filNewPic" name="filNewPic" type="file" /></li>
                <li><input id="pbNewPic" name="pbNewPic" type="submit" value="Byt billed"/></li>
            </ul>
        </form>
        <form id="frm_product_pdf" name="frm_product_pdf" method="post" enctype="multipart/form-data" action="<?php echo $cms_file_upload; ?>">
            <ul>
                <li>Nuværende PDF: <span id="spPDFName" class="media-name"></span></li>
                <li id="productPDFPreview"></li>
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
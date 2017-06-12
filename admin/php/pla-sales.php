<?php

require('php/classes/pla-brand.class.php');
require('php/classes/pla-cat.class.php');
require('php/classes/pla-item.class.php');

?>
<div class="sales">
    <form id="frm_sales" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<!-- *** START *** Items -->
        <fieldset class="items">
            <legend>Varer</legend>
            Vælg eksisterende: <select class="itemlist">
                <option value="-1" selected="selected">- ingen -</option>
<?php
    $topItemSQL = "SELECT * FROM jes_items i ORDER BY i.i_brand";
    $topItemRe = $db->query($topItemSQL);
    while($topItemRow = $topItemRe->fetch_object()) {
        echo "<option value=\"".$topItemRow->i_id."\">".$topItemRow->i_title."</option>\n";
    }
?>
            </select>
            <div class="details">
                <p class="cat-wrapper">
                    Hoved kategorie: 
                    <select class="cat1list">
                        <option value="-1" selected="selected">- ingen -</option>
<?php
    $cat1SQL = "SELECT * FROM jes_cats c WHERE c.cat_owner = 0 ORDER BY c.cat_name";
    $cat1Re = $db->query($cat1SQL);
    while($cat1Row = $cat1Re->fetch_object()) {
        echo "<option value=\"".$cat1Row->cat_idx."\">".$cat1Row->cat_name."</option>\n";
    }
?>
                    </select>
                    Sub kategorie: 
                    <select class="cat2list">
                        <option value="-1" selected="selected">- ingen -</option>
                    </select>
                </p>
                <p class="brand-wrapper">
                    Mærke: 
                    <select class="brandlist">
                        <option value="-1" selected="selected">- ingen -</option>
<?php
    $topBrandSQL = "SELECT * FROM jes_brands b ORDER BY b.b_text";
    $topBrandRe = $db->query($topBrandSQL);
    while($topBrandRow = $topBrandRe->fetch_object()) {
        echo "<option value=\"".$topBrandRow->b_idx."\">".$topBrandRow->b_text."</option>\n";
    }
?>
                    </select>
                </p>
                <p class="name">
                    Titel: <input class="title" type="text" /> <button class="button new">Tilføj ny</button>
                </p>
                <p class="details">
                    Pris (uden punktummer og komma): <input class="price" type="text" />
                    Antal:
                    <select class="qty">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <input class="active" type="checkbox" /> Aktiv
                </p>
                <p>
                    Beskrivelse: <textarea class="desc" id="taItemDesc"></textarea>
                </p>
                <p class="pic">
                    Nuværende billede: <img src="" alt="logo" />
                    <span class="options-wrapper">
                        <button class="button swap-picture">Byt billede</button> <input class="new-picture" type="file" name="fil_item_picture" />
                    </span>
                </p>
                <hr />
                <p class="pdf">
                    Nuværende PDF: <span id="itemPDFPreview"></span>
                    <span class="options-wrapper">
                        <button class="button swap-pdf">Byt PDF</button> <input class="new-pdf" type="file" name="fil_item_pdf" />
                    </span>
                </p>
                <hr />
            </div>
            <button class="button save">Gem ændringer</button> <button class="button delete">Slet</button>
        </fieldset>
<!-- *** END *** Items -->



<!-- *** START *** Brands -->
        <fieldset class="brands">
            <legend>Mærker</legend>
            <select class="brandlist">
                <option value="-1">- ingen -</option>
<?php
    $topBrandSQL = "SELECT * FROM jes_brands b ORDER BY b.b_text";
    $topBrandRe = $db->query($topBrandSQL);
    while($topBrandRow = $topBrandRe->fetch_object()) {
        echo "<option value=\"".$topBrandRow->b_idx."\">".$topBrandRow->b_text."</option>\n";
    }
?>
            </select>
            <button class="button new">Tilføj ny</button>
            <div class="details">
                <p class="name">
                    Tekst: <input class="text" type="text" />
                </p>
                <p class="logo">
                    Nuværende logo: <img src="" alt="logo" />
                    <span class="options-wrapper">
                        <button class="button swap-logo">Byt logo</button> <input class="new-logo" type="file" name="fil_logo" />
                    </span>
                </p>
            </div>
            <hr />
            <button class="button save">Gem ændringer</button> <button class="button delete">Slet</button>
        </fieldset>
<!-- *** END *** Brands -->



<!-- *** START *** Categories -->
        <fieldset class="cats">
            <legend>Kategorier</legend>
            Hovedkategori: 
            <select class="maincatlist">
                <option value="-1">- ingen -</option>
<?php
    $topCatSQL = "SELECT * FROM jes_cats c WHERE c.cat_owner=0";
    $topCatRe = $db->query($topCatSQL);
    while($topCatRow = $topCatRe->fetch_object()) {
        echo "<option value=\"".$topCatRow->cat_idx."\">".$topCatRow->cat_name."</option>\n";
    }
?>
            </select>
            <br><br>
            Subkategori: 
            <select class="subcatlist">
                <option value="-1">- ingen -</option>
            </select>
            <br><br>
            <p class="cat">
                Tekst: <input class="text" type="text" />
            </p>
            <br>
            <button class="button save">Gem ændringer</button> <button class="button new">Tilføj ny</button> <button class="button delete">Slet</button>
        </fieldset>
<!-- *** END *** Categories -->




    </form>
</div>
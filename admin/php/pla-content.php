<div class="content container">
    <form class="content-details" name="frm_content_details" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Vælg container element:
        <select id="selElement" name="selElement">
            <option value="-1">&nbsp</option>
    <?php

        global $db;
        $geQ = "SELECT ge.name, ge.title, ge.desc, ge.img, ge.location, ge.size, ge.decorations, ge.footer FROM gridelements ge ORDER BY ge.name";
        $geRe = $db->query($geQ);
        while ($geRo = $geRe->fetch_object()) {
            echo "        <option value=\"".$geRo->name."\">".$geRo->name."</option>\n";
        }

    ?>
        </select>
        <input class="del-element" name="pbDelElement" type="button" value="Slet" class="button" />
        <fieldset class="page-detail">
            <legend>Element indhold</legend>
            <div class="form-group">
                <label for="txtGEName">Navn:</label>
                <input type="input" class="form-control" id="txtGEName" placeholder="Element navn" value="">
            </div>
            <ul>
                <li>Heading:</li>
                <li><input id="txtGETitle" name="txtGETitle" type="input" /> <button type="submit" class="btn btn-primary" id="pbNewElement" name="pbNewElement">Tilføj ny element</button></li>
            </ul>
            <ul>
                <li>Indhold:</li>
                <li><textarea id="taGEDesc" name="taGEDesc" /></textarea>
            </ul>
            <ul>
                <li>Placering:</li>
                <li><textarea id="selGELocation" name="selGELocation" /></textarea>
            </ul>
            <ul>
                <li>
                    <label for="selGESize">Størrelse:</label>
                    <select id="selGESize" name="selGESize">
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                    </select>
                </li>
            </ul>
            <ul>
                <li>
                    <label for="selGEBackground">Baggrund:</label>
                    <select id="selGEBackground" name="selGEBackground">
                        <option value="S">Small</option>
                        <option value="C">Chalkboard</option>
                        <option value="D">Dirt</option>
                    </select>
                </li>
            </ul>
            <button type="submit" class="btn btn-primary" id="pbSaveGE" name="pbSaveGE">Gem ændringer</button>
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
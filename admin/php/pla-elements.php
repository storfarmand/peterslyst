<div class="content container">
    <form class="ele-details" id="frm_ele_details" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Vælg element:
        <select class="form-inline" name="sel-ele" id="sel-ele">
            <option value="-1">- ingen -</option>
    <?php
        $eleQ = "select idx, name, title from gridelements order by title";
        $eleRe = $db->query($eleQ);
        while ($eleRo = $eleRe->fetch_object()) {
            echo "        <option value=\"".$eleRo->idx."\">".$eleRo->title."</option>\n";
        }
    ?>
        </select>
        <button type="submit" class="btn btn-danger btn-del-ele" id="pb-ele-del" name="pb-ele-del">Slet</button>
        <fieldset class="ele-detail container-fluid">
            <legend>Element indhold</legend>
            <div class="form-group">
                <label for="txt-ele-title">Titel</label>
                <input type="text" class="form-control" name="txt-ele-title" id="txt-ele-title" placeholder="Element titel" value="">
            </div>
            <div class="form-group">
                <label for="sel-ele-type">Type</label>
                <select class="form-control" name="sel-ele-type" id="sel-ele-type">
                    <option value="T" selected="selected">Tekst</option>
                    <option value="I">Billede</option>
                </select>
            </div>
            <div class="form-group">
                <label for="txt-ele-desc">Beskrivelse</label>
                <textarea class="form-control" name="txt-ele-desc" id="txt-ele-desc" placeholder="Element beskrivelse" rows="8"></textarea>
            </div>
            <div class="form-group">
                <label for="txt-ele-header">Header</label>
                <input type="checkbox" name="cb-ele-header" id="cb-ele-header" value="Y"> Aktiv
                <input type="text" class="form-control" name="txt-ele-header" id="txt-ele-header" placeholder="Element header" value="">
            </div>
            <div class="form-group">
                <label for="txt-ele-footer">Footer</label>
                <input type="checkbox" name="cb-ele-footer" id="cb-ele-footer" value="Y"> Aktiv
                <input type="text" class="form-control" name="txt-ele-footer" id="txt-ele-footer" placeholder="Element footer" value="">
            </div>
            <div class="form-group">
                <label for="sel-ele-size">Størrelse (hvor mange kolonner)</label>
                <select class="form-control" name="sel-ele-size" id="sel-ele-size">
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                </select>
            </div>
            <div class="form-group ele-effects">
                <label>Baggrund: </label>
                <input type="radio" name="rb-ele-bg" id="cb-ele-default" value="default" checked> Default
                <input type="radio" name="rb-ele-bg" id="cb-ele-dirt" value="dirt"> Brun
                <input type="radio" name="rb-ele-bg" id="cb-ele-chalkboard" value="chalkboard"> Tavle
            </div>
            <button type="submit" class="btn btn-primary" id="pb-ele-save" name="pb-ele-save" disabled>Gem ændringer</button>
        </fieldset>
    </form>

    <fieldset>
        <legend>Medie</legend>
        <form class="ele-media" id="frm_ele_media" method="post" enctype="multipart/form-data" action="<?php echo $cms_file_upload; ?>">
            <ul>
                <li>Nuværende billed: <span class="ele-media-name"></span></li>
                <li class="ele-media-preview"><img src="" alt="" /></li>
                <li><input class="ele-media-new" name="fil-ele-media" type="file" disabled/></li>
                <li><button class="ele-media-new" name="pb-ele-media" type="submit" disabled>Byt billed</button></li>
            </ul>
            <div class="progress">
                <div class="bar"></div >
                <div class="percent">0%</div >
            </div>
            <div id="status"></div>
        </form>
    </fieldset>
</div>
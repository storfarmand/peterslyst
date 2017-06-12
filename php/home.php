<?php
$containerOutputted = false;
$gridCQ = "select gc.idx from gridcontainers gc where active=\"Y\" order by location";
$gridCRe = $db->query($gridCQ);
if (!$gridCRe){
    die($db->error);
}
while($gridCRo = $gridCRe->fetch_object()) {
    $gridContainer = new gridContainer($gridCRo->idx);

    $gcDecorations = explode(",",$gridContainer->getDecorations());
    $gcDecorationsClass = "";
    foreach ($gcDecorations as $gcDIdx=>$gcDVal) {
        $gcDecorationsClass .= " $gcDVal";
    }
    echo "            <section class=\"container-fluid $gcDecorationsClass\">\n";
    $containerOutputted = true;
    
    $gridIQ = "select ge.idx from gridelements ge where containerIdx=$gridCRo->idx order by location";
    $gridIRe = $db->query($gridIQ);
    if (!$gridIRe){
        die($db->error);
    }
    while($gridIRo = $gridIRe->fetch_object()) {
        $gridElement = new gridElement($gridIRo->idx);

        $giDecorations = explode(",",$gridElement->getDecorations());
        $giDecorationsClass = "";
        foreach ($giDecorations as $giDIdx=>$giDVal) {
            $giDecorationsClass .= " $giDVal";
        }
        
        $gridStructure = "";
        switch ($gridElement->getSize()) {
            case "S":
                $gridStructure = " col-lg-2 col-md-2 col-sm-4 col-xs-10 ";
                break;
            case "M":
                $gridStructure = " col-lg-3 col-md-3 col-sm-6 col-xs-10";
                break;
            case "L":
                $gridStructure = " col-lg-5 col-md-5 col-sm-10 col-xs-10";
                break;
            default:
                $gridStructure = "";
        }
        echo "<article class=\" $gridStructure \">\n";
        switch ($gridElement->getType()) {
            case "T":
                echo "                <div class=\"infobox $giDecorationsClass \">\n";
                if ($gridElement->isLinkable()) echo "<a href=\"".$gridElement->getLink()."\">\n";
                echo "                    <h2>".$gridElement->getTitle()."</h2>\n";
                echo "                    <p>".$gridElement->getDesc()."</p>\n";
                if ($gridElement->getFooterActive() == "Y") echo "<p class=\"footer\">".$gridElement->getFooter()."</p>\n";
                if ($gridElement->isLinkable()) echo "</a>\n";
                echo "                </div>\n";
                break;
            case "U":
                echo "                <div class=\"infobox $giDecorationsClass \">\n";
                if ($gridElement->isLinkable()) echo "<a href=\"".$gridElement->getLink()."\">\n";
                echo "                    <h2>".$gridElement->getTitle()."</h2>\n";
                echo "                    <p>".$gridElement->getDesc()."</p>\n";
                if ($gridElement->getFooterActive() == "Y") echo "<p class=\"footer\">".$gridElement->getFooter()."</p>\n";
                if ($gridElement->isLinkable()) echo "</a>\n";
                echo "                </div>\n";
                break;
            case "I":
                echo "                <div class=\"media\">\n";  //decoration classes go here
                echo "                    <img src=\"".$site_media_base . $gridElement->getIdx() . '/' . $gridElement->getImg()."\" alt=\"".$gridElement->getTitle()."\"\n";
                echo "                </div>\n";
                break;
            case "R":
                echo $gridElement->getDesc();
                break;
            default:
        }
        echo "            </article>\n";
    }
    echo "            </section>\n";
}

?>

        <section class="container tall">
            <article class="col-lg-3 col-md-3 col-sm-6 col-xs-10">
                <div class="infobox chalkboard">
                    <?php $gi = getContent("butiktavlen"); ?>
                    <h2><?php echo $gi->title; ?></h2>
                    <p><?php echo $gi->desc; ?></p>
                    <p class="footer"><?php echo $gi->footer; ?></p>
                </div>
            </article>
            <article class="col-lg-2 col-md-2 col-sm-4 col-xs-10">
                <div class="infobox">
                    <?php $gi = getContent("feature"); ?>
                    <h2><?php echo $gi->title; ?></h2>
                    <?php echo $gi->desc; ?>
                </div>
            </article>
            <article class="col-lg-3 col-md-3 col-sm-6 col-xs-10">
                <div class="media">
                    <?php $gi = getContent("featureimg"); ?>
                    <img src="gfx/<?php echo $gi->img; ?>" alt="<?php echo $gi->title; ?>" />
                </div>
            </article>
            <article class="col-lg-2 col-md-2 col-sm-4 col-xs-10">
                <div class="infobox chalkboard small">
                    <?php $gi = getContent("åbningstider_lukket"); ?>
                    <h2><?php echo $gi->title; ?></h2>
                    <?php echo $gi->desc; ?>
                </div>
            </article>
        </section>
        <section class="container">
            <article class="col-lg-2 col-md-2 col-sm-4 col-xs-10">
                <div class="media">
                    <a href="vikarservice">
                        <?php $gi = getContent("palleimg"); ?>
                        <img src="gfx/<?php echo $gi->img; ?>" alt="<?php echo $gi->title; ?>" />
                    </a>
                </div>
            </article>
            <article class="col-lg-3 col-md-3 col-sm-6 col-xs-10">
                <div class="infobox services">
                    <a href="vikarservice">
                        <?php $gi = getContent("vikarservice"); ?>
                        <h2><?php echo $gi->title; ?></h2>
                        <?php echo $gi->desc; ?>
                    </a>
                </div>
            </article>
            <article class="col-lg-2 col-md-2 col-sm-4 col-xs-10">
                <div class="infobox dirt">
                    <?php $gi = getContent("findos"); ?>
                    <h2><?php echo $gi->title; ?></h2>
                    <a href="https://www.google.dk/maps/place/G%C3%A5rdbutikken+Peterslyst/@56.079399,10.0822,17z/data=!3m1!4b1!4m2!3m1!1s0x464c6a36fc5e8da9:0xccb540cab96e8ca" target="_blank"><?php echo $gi->desc; ?></a>
                    <a href="https://plus.google.com/101019668276839283643" rel="publisher">Peterslyst på Google+</a>
                </div>
            </article>
            <article class="col-lg-3 col-md-3 col-sm-6 col-xs-10">
                <div class="map google"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2226.4922126428332!2d10.082200000000007!3d56.07939899999986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x464c6a36fc5e8da9%3A0xccb540cab96e8ca!2sG%C3%A5rdbutikken+Peterslyst!5e0!3m2!1sda!2sdk!4v1407683135558" frameborder="0" style="border:0"></iframe></div>
            </article>
        </section>
        <section class="container tall">
            <article class="col-lg-5 col-md-5 col-sm-10 col-xs-10">
                <div class="media slider">
                    <a href="campingvogn">
                        <div>
                            <img src="media/slider/hobby-prestige.jpg" alt="Campingvogn udlejes - Hobby prestige" class="slider-element" />
                            <img src="media/slider/knaus-sudwind.jpg" alt="Campingvogn udlejes - Knaus Sudwind" class="slider-element" />
                            <img src="media/slider/knaus-azur.jpg" alt="Campingvogn udlejes - Knaus Azur" class="slider-element" />
                        </div>
                    </a>
                </div>
            </article>
            <article class="col-lg-3 col-md-3 col-sm-6 col-xs-10">
                <div class="infobox">
                    <a href="udvalg">
                        <?php $gi = getContent("kvalitet"); ?>
                        <h2><?php echo $gi->title; ?></h2>
                        <?php echo $gi->desc; ?>
                    </a>
                </div>
            </article>
            <article class="col-lg-2 col-md-2 col-sm-4 col-xs-10">
                <div class="media">
                    <a href="historie">
                        <?php $gi = getContent("gårdenshistorie"); ?>
                        <img src="gfx/<?php echo $gi->img; ?>" alt="<?php echo $gi->title; ?>" />
                    </a>
                </div>
            </article>
        </section>
        <section class="container">
            <article class="news-signup col-lg-5 col-md-5 col-sm-10 col-xs-10">
                <div class="infobox dirt container-fluid">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                        <?php $gi = getContent("nyhedsbrev"); ?>
                        <h2><?php echo $gi->title; ?></h2>
                        <?php echo $gi->desc; ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
						<a href="https://www.facebook.com/gaardbutikken.peterslyst" class="facebook" target="_blank"><i class="fa fa-facebook-official fa-3x"></i></a>			
                    </div>                    
                </div>
            </article>
            <article class="col-lg-2 col-md-2 col-sm-4 col-xs-10">
                <div class="infobox chalkboard small">
                    <a href="udlejning">
                        <?php $gi = getContent("udlejningsliste"); ?>
                        <h2><?php echo $gi->title; ?></h2>
                        <?php echo $gi->desc; ?>
                    </a>
                </div>
            </article>
            <article class="col-lg-3 col-md-3 col-sm-6 col-xs-10">
                <div class="infobox">
                    <a href="udlejning">
                        <?php $gi = getContent("udlejning"); ?>
                        <h2><?php echo $gi->title; ?></h2>
                        <?php echo $gi->desc; ?>
                    </a>
                </div>
            </article>
        </section>

<div id="navcontainer" class="row">
    <button class="navbar-toggle hidden-lg hidden-md hidden-sm visible-xs-block" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <ul id="navlist" class="nav nav-tabs">

    <?php

switch ($navbar) {
    case "content" :
        echo "        <li class=\"active\"><a href=\"".$_SERVER['PHP_SELF']."?action=vcontent\">Indhold</a></li>\n";
        echo "        <li><a href=\"".$_SERVER['PHP_SELF']."?action=vgallery\">Galleri</a></li>\n";
        echo "        <li><a href=\"".$_SERVER['PHP_SELF']."?action=vbizinfo\">Firmaoplysninger</a></li>\n";
        break;
    case "gallery" :
        echo "        <li><a href=\"".$_SERVER['PHP_SELF']."?action=vcontent\">Indhold</a></li>\n";
        echo "        <li class=\"active\"><a href=\"".$_SERVER['PHP_SELF']."?action=vgallery\">Galleri</a></li>\n";
        echo "        <li><a href=\"".$_SERVER['PHP_SELF']."?action=vbizinfo\">Firmaoplysninger</a></li>\n";
        break;
    case "bizinfo" :
        echo "        <li><a href=\"".$_SERVER['PHP_SELF']."?action=vcontent\">Indhold</a></li>\n";
        echo "        <li><a href=\"".$_SERVER['PHP_SELF']."?action=vgallery\">Galleri</a></li>\n";
        echo "        <li class=\"active\"><a href=\"".$_SERVER['PHP_SELF']."?action=vbizinfo\">Firmaoplysninger</a></li>\n";
        break;
}
?>

    </ul>
</div>

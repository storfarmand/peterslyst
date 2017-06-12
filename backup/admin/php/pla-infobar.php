<div class="infobar">
    <div>
        <ol class="breadcrumb col-lg-3 col-md-3 col-sm-3 col-xs-4">
            <li><a href="<?php echo $cms_launch; ?>">CMS</a></li>
            <li class="active"><a href="#"><?php echo $pg_status; ?></a></li>
        </ol>
        <div id="user_info" class="alert alert-info col-lg-3 col-lg-offset-6 col-md-3 col-md-offset-6 col-sm-4 col-sm-offset-5 col-xs-7 col-xs-offset-1">Bruger: <strong><?php echo $_SESSION['seq_userid']; ?></strong> (<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=logout">Log ud</a>)</div>
    </div>
</div>

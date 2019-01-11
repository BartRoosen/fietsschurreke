<?php
use Classes\Navigation\NavHandler;

$navHandler = new NavHandler();

$bikeId = $navHandler->getSession()->getBikeId();
?>

<div class="page-content home-content container-fluid">
    <div class="bottom-filler"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
            <?php include "specs.php"; ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
            <?php include "pictures.php"; ?>
        </div>
    </div>
</div>

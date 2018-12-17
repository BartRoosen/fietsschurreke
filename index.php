<?php

include 'auto_load.php';

use Classes\Entities\BikeRepository;
use Classes\Entities\Opening;
use Classes\Entities\OpeningRepository;
use Classes\Loaders\CssLoader;
use Classes\Loaders\JsLoader;
use Classes\Navigation\NavHandler;

$cssLoader = new CssLoader();
$jsLoader  = new JsLoader();
$open      = new OpeningRepository();
$nav       = new NavHandler();

$cssHtml      = $cssLoader->getHtml();
$jsHtml       = $jsLoader->getHtml();
$openingHours = $open->getOpeningHours();

$pagePath = $nav->getPagePath();
$page     = $nav->getPage();

include 'components/template.php';
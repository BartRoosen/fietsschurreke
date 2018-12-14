<?php

use Classes\Entities\BikeRepository;
use Classes\Entities\Opening;
use Classes\Entities\OpeningRepository;
use Classes\Loaders\CssLoader;
use Classes\Loaders\JsLoader;

include 'auto_load.php';

$cssLoader    = new CssLoader();
$jsLoader     = new JsLoader();
$open         = new OpeningRepository();
$cssHtml      = $cssLoader->getHtml();
$jsHtml       = $jsLoader->getHtml();
$openingHours = $open->getOpeningHours();

include 'components/template.php';

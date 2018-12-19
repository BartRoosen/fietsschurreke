<?php

include 'auto_load.php';

use Classes\Config\DataRequired;
use Classes\Entities\BikeRepository;
use Classes\Entities\OpeningRepository;
use Classes\Loaders\CssLoader;
use Classes\Loaders\JsLoader;
use Classes\Navigation\NavHandler;
use Classes\Services\DataFetcher;
use Classes\Services\TemplateRenderer;

$cssLoader = new CssLoader();
$jsLoader  = new JsLoader();
$open      = new OpeningRepository();
$nav       = new NavHandler();
$session   = $nav->getSession();

$cssHtml      = $cssLoader->getHtml();
$jsHtml       = $jsLoader->getHtml();
$openingHours = $open->getOpeningHours();
$pagePath     = $nav->getPagePath();
$page         = $session->getPage();
$picture      = $session->getPicture();

if (in_array($page, DataRequired::PAGES)) {
    $bikeRepo         = new BikeRepository();
    $dataFetcher      = new DataFetcher($bikeRepo);
    $templateRenderer = new TemplateRenderer($dataFetcher, 'bike');

    $bikeInfo = $templateRenderer->renderBikeInfo($page);
}

include 'components/template.php';
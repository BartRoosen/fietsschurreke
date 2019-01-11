<?php
use Classes\Services\CarouselRenderer;

$cr = new CarouselRenderer('img/ebike/');

echo $cr->renderCarousel('Projecten');

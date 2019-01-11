<?php
use Classes\Services\CarouselRenderer;

$cr = new CarouselRenderer(sprintf('img/bikes/%s/', $bikeId));

echo $cr->renderCarousel('Foto\'s');
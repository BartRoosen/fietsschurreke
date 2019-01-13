<?php

use Classes\Services\SpecsRenderer;

$specs = new SpecsRenderer();

echo $specs->getBikeSpecs($bikeId);
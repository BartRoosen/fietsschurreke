<?php

include 'auto_load.php';

use Classes\Entities\Session;
use Classes\Navigation\NavHandler as Handler;

$session = new Session();
$handler = new Handler();

if (isset($_GET, $_GET['page'])) {
    $session->setPage($_GET['page']);
}

$handler->setSession($session);

header('location: ./');
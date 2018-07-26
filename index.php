<?php

include 'auto_load.php';

use Classes\Display\Info;

$info = new Info();
?>


<!DOCTYPE html>
<html>
<head>
	<title>TEST AUTO LOADER</title>
</head>
<body>
    <?= $info->getInfo() ?>
</body>
</html>
<?php

declare(strict_types = 1);

require('../vendor/autoload.php');
$templates = new League\Plates\Engine(__DIR__ . '/views');
echo $templates->render('index');

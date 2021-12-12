<?php

declare(strict_types = 1);

require('../vendor/autoload.php');
use CodeLts\U2F\U2FServer\U2FServer as U2F;

var_dump(U2F::checkOpenSSLVersion());

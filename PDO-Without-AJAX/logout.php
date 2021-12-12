<?php

declare(strict_types = 1);

require('functions.php');
session_start();
unset($_SESSION['authenticatedUser']);
redirect('index.php');

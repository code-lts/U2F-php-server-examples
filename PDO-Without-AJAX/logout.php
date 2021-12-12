<?php

require("functions.php");

session_start();
unset($_SESSION['authenticatedUser']);

redirect("index.php");
<?php

require_once("../functions.php");

$pdo = getDBConnection();

// Insert User seeds
$pdo->exec("
    INSERT INTO `users` VALUES (1,'williamdes');
    INSERT INTO `users` VALUES (2,'donkey');
    INSERT INTO `users` VALUES (3,'shrek');
");

echo "Your database is seeded.<br/>";
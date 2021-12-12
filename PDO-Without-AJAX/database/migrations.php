<?php

declare(strict_types = 1);

require_once('../functions.php');
$pdo = getDBConnection();
// Create users table
$pdo->exec(
    'create table if not exists users (
        id integer primary key,
        name varchar(255)
    )'
);
// Create registrations table
$pdo->exec(
    'create table if not exists registrations (
        id integer primary key,
        user_id integer,
        keyHandle varchar(255),
        publicKey varchar(255),
        certificate text,
        counter integer
    )'
);
echo 'Database migration completed.<br/>';

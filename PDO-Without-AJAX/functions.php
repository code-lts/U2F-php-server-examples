<?php

declare(strict_types = 1);

use CodeLts\U2F\U2FServer\Registration;

function redirect(string $location): void
{
    header('Location: ' . $location);
    die();
}

function appID(): string
{
    $scheme = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    return $scheme . $_SERVER['HTTP_HOST'];
}

function getDBConnection(): PDO
{
    $SQLiteFile = __DIR__ . '/database/database.sqlite';
    $pdo        = new PDO('sqlite:' . $SQLiteFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $pdo;
}

function getUser(string $name)
{
    $pdo       = getDBConnection();
    $statement = $pdo->prepare('SELECT * FROM users WHERE NAME = ?');
    $statement->execute([$name]);
    return $statement->fetch();
}

function getU2FRegistrations(stdClass $user)
{
    $pdo       = getDBConnection();
    $statement = $pdo->prepare('SELECT * FROM registrations WHERE user_id = ?');
    $statement->execute([$user->id]);
    return $statement->fetchAll();
}

function storeU2FRegistration(stdClass $user, Registration $registration): void
{
    $pdo       = getDBConnection();
    $statement = $pdo->prepare(
        '
        INSERT INTO registrations
        (user_id, keyHandle, publicKey, certificate, counter)
        VALUES (?, ?, ?, ?, ?)
        '
    );
    $statement->execute(
        [
            $user->id,
            $registration->getKeyHandle(),
            $registration->getPublicKey(),
            $registration->getCertificate(),
            $registration->getCounter()
        ]
    );
}

function updateU2FRegistration(stdClass $registration): void
{
    $pdo       = getDBConnection();
    $statement = $pdo->prepare('UPDATE registrations SET counter = ? WHERE id = ?');
    $statement->execute([$registration->counter, $registration->id]);
}

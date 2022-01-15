#!/usr/bin/php
<?php

use App\Repository;
use App\Api;
use App\App;

require_once __DIR__ . '/vendor/autoload.php';

$createRepoParking = new Repository('data');                                    // Создание репозитория
$api = new Api($createRepoParking);                                                     // создание объекта API парковок из репозитория

try {
    $App = new App($createRepoParking);
    $App->run();
} catch (\Throwable $e) {
    echo $e->getMessage();
}


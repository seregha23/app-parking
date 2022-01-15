<?php

use App\Api;

require_once __DIR__ . '/../vendor/autoload.php';


$newParking = new Api();
$createParking = $newParking->createParking(10);



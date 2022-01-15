<?php

use App\Parking;
use App\Car;

require_once __DIR__ . '/../vendor/autoload.php';

$newParking = new Parking(1);

$toyota = new Car();
$skoda = new Car();
$lada = new Car();

$newParking->park($toyota);
$newParking->park($skoda);
$newParking->park($lada);
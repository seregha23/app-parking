<?php

use App\Parking\Parking;
use App\Parking\Car;
use App\Parking\Bike;
use App\Parking\Truck;

require_once __DIR__ . '/../vendor/autoload.php';

$newParking = new Parking(2);

$toyota = new Car(111);
$toyota2 = new Car(22211);




$newParking->park($toyota);
$newParking->park($toyota2);


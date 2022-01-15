<?php

use App\Parking;
use App\Car;

require_once __DIR__ . '/../vendor/autoload.php';

$newParking = new Parking(10);

$toyota = new Car(111);
$toyota2 = new Car(222);
$toyota3 = new Car(333);
$toyota4 = new Car(444);



$newParking->park($toyota);
$newParking->park($toyota2);
$newParking->park($toyota3);
$newParking->park($toyota4);
$newParking->parkOut($toyota3->showVin());


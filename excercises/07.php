<?php

use App\Api;
use App\Repository;

require_once __DIR__ . '/../vendor/autoload.php';

$createRepoParking = new Repository('data');
$newParkingApi = new Api($createRepoParking);

$createParking = $newParkingApi->create(10, $createRepoParking);
//$newParking = $createRepoParking->save($createParking);
//
//$createParking2 = $newParkingApi->create(5);
//$newParking2 = $createRepoParking->save($create2);


//$loadParkingId1 = $createRepoParking->loadAll();
//$allParking = $createRepoParking->getFreeId();





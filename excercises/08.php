<?php

use App\Repository;
use App\Api;
use App\ApiException;

require_once __DIR__ . '/../vendor/autoload.php';

$createRepoParking = new Repository('data');
$newParkingApi = new Api($createRepoParking);

// Создать парковку (передается вместимость парковки)
// $newParkingApi->create(4);

// Получить все парковки
// $newParkingApi->loadAll();

// Получить парковку по id
// var_dump($newParkingApi->load('1679'));

// Поставить ТС(автомобиль) на парковку (id парковки, тип ТС, VIN ТС)
try {
    $newParkingApi->park('1679', 'caar', '123');
} catch (ApiException $e) {
    var_dump($e->getPrevious());
    echo $e->getMessage();
}

// Поставить ТС(мотоцикл) на парковку (id парковки, тип ТС, VIN ТС)
// $newParkingApi->park('1679', 'bike', '234');

// Выгнать ТС с парковки (id парковки, VIN ТС)
// $newParkingApi->parkOut('1679', '234');

// Удалить парковку по id
// $newParkingApi->delete('c9f0');







<?php

use App\Repository;
use App\Api;
use App\ApiResponse;
use App\ApiException;


require_once __DIR__ . '/../vendor/autoload.php';
$createRepoParking = new Repository('data');
$parkingApi = new Api($createRepoParking);
//$loadAllParking = $parkingApi->loadAll();
//$parkingApi->park('1679', 'carrr', '12345');
try {
    $apiResponse = new ApiResponse( $createRepoParking);
    $loadParking = $parkingApi->load('1679')->getResponse();
    $loadAllParking = $parkingApi->loadAll()->getResponse();

    echo '<pre>';
    var_dump($apiResponse->getResponse($loadAllParking));
    echo '</pre>';
//    var_dump($apiResponse->getResponse());
//    print_r($apiResponse->getResponse());
} catch (ApiException $e) {
    echo $e->getMessage();
}






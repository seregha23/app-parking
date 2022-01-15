<?php

namespace App\Parking;

class Car extends Transport
{
    protected string $type = 'car';  // тип транспорта
    protected const OCCUPIED = 1;   // занимаемое место на парковке
}



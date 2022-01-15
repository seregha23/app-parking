<?php

namespace App\Parking;

class Truck extends Transport
{
    protected string $type = 'truck';   // тип транспорта
    protected const OCCUPIED = 2;       // занимаемое место на парковке
}
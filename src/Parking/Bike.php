<?php

namespace App\Parking;

class Bike extends Transport
{
    protected string $type = 'bike'; // тип транспорта
    protected const OCCUPIED = 0.5; // занимаемое место на парковке
}
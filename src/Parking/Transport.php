<?php

namespace App\Parking;

abstract class Transport
{
    protected string $type = 'null';    // тип транспорта
    protected string $vin = 'null';              // VIN транспорта
    protected const OCCUPIED = null;    // Занимаемое место транспортом

    public function __construct(string $vin)
    {
        $this->vin = $vin;
    }

    // Получить тип траспорта
    public function getType(): string
    {
        return $this->type;
    }

    // Получить VIN транспорта
    public function getVin(): string
    {
        return $this->vin;
    }

    // Получить занимаемое место транспортом
    public function occupiedSpace(): float
    {
        return static::OCCUPIED;
    }
}
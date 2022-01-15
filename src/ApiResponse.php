<?php

namespace App;

use App\Parking\Parking;

class ApiResponse
{
    protected $parking; // Парковка

    public function __construct($parking)
    {
        $this->parking = $parking;
    }

    // Пересобрать парковку в массив
    protected function rebuildParkingToArray(Parking $objectParking): array
    {
        $parkingToFill = [];                                              // Массив парковки для заполнения
        $parkingToFill['id'] = $objectParking->getId();                   // Поле id парковки
        $parkingToFill['capacity'] = $objectParking->getCapacity();       // Поле вместимость парковки
        $parkingToFill['places'] = $objectParking->getPlaces();           // Занимаемые места на парковке
        return $parkingToFill;
    }

    // Представление парковки
    public function getResponse(): array
    {
        // Ответ для всех парковок
        if (is_array($this->parking)) {
            $allParking = [];
            foreach ($this->parking as $parkItem) {
                $allParking[] = $this->rebuildParkingToArray($parkItem);
            }
            return $allParking;
        }

        // Ответ при загрузке одной парковки
        return $this->rebuildParkingToArray($this->parking);
    }
}
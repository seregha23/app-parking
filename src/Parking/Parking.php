<?php

namespace App\Parking;

use App\Repository;

class Parking
{
    public string $id;          // id парковки
    protected int $capacity;    // вместимость парковки
    public array $places = [];  // занимаемые места на парковке

    public function __construct(string $id, int $capacity)
    {
        // id парковки
        $this->id = $id;
        // вместимость парковки
        $this->capacity = $capacity;

        if ($capacity < 0) {
            throw new \DomainException('Кол-во мест не может быть меньше нуля!!');
        }
        if ($capacity === 0) {
            throw new \DomainException('Кол-во мест не может быть равно ноль!!');
        }
    }

    // Припарковать автомобиль
    public function park(Transport $transport): array
    {
        // Занято мест
        $sumPlaces = 0;
        foreach ($this->places as $place) {
            $sumPlaces += $place->occupiedSpace();
        }
        $sumPlaces += $transport->occupiedSpace();
        // При отсутствии свободных мест выкидывать исключение
        if ($sumPlaces > $this->capacity) {
            throw new \DomainException('Свободных мест нет');
        }
        // Проверка на существующий VIN
        foreach ($this->places as $place) {
            if ($transport->getVin() === $place->getVin()) {
                throw new \DomainException('Вы пытаетесь запарковать машину с существующим VIN !!!');
            }
        }
        // Паркуем транспорт
        $this->places[] = $transport;
        return $this->places;
    }


    // Отпарковать автомобиль
    public function parkOut(string $vin): bool
    {
        foreach ($this->places as $key => $place) {
            // Удаление VIN из массива VINs
            if ($vin === $place->getVin()) {
                unset($this->places[$key]);
                return true;
            }
        }
        // Выкинуть ошибку при отсутствии VIN у запаркованных авто
        throw new \DomainException('Такого авто на парковке нет !!!');
    }

    // Получить id
    public function getId(): string
    {
        return $this->id;
    }

    // Получить вместимость
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    // Получить атрибуты транспорта
    public function getPlaces(): array
    {
        $places = [];
        foreach ($this->places as $key => $transport) {
            $places[$key]['type'] = $transport->getType();
            $places[$key]['vin'] = $transport->getVin();
        }
        return $places;
    }
}
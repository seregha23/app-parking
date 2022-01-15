<?php

namespace App;

use App\Parking\Parking;

class Api
{
    protected object $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    // Создать парковку
    public function create(int $capacity): ApiResponse
    {
        $parking = new Parking($this->repository->getFreeId(), $capacity);
        return new ApiResponse($this->repository->save($parking));
    }

    // Получить все парковки
    public function loadAll(): ApiResponse
    {
        return new ApiResponse($this->repository->loadAll());
    }

    // Получить конкретную парковку
    public function load(string $id): ApiResponse
    {
        return new ApiResponse($this->repository->load($id));
    }

    // Поставить ТС на парковку
    public function park(string $id, string $typeTransport, string $vin): Parking
    {
        $classTransport = "App\\Parking\\" . ucfirst($typeTransport);
        if (!class_exists($classTransport)) {
            throw new ApiException('Ошибка API: нет такого транспорта');
        }

        $transport = new $classTransport($vin);
        $parking = $this->repository->load($id);
        $parking->park($transport);
        $this->repository->save($parking);
        return $parking;
    }

    // Выгнать ТС с парковки
    public function parkOut(string $id, string $vin): Parking
    {
        $parking = $this->repository->load($id);
        $parking->parkOut($vin);
        $this->repository->save($parking);
        return $parking;
    }

    // Удалить парковку
    public function delete(string $id): ApiResponse
    {
        return new ApiResponse($this->repository->delete($id));
    }

    // Запустить приложение
    public function runApp(...$args): bool
    {
        if ($args[1] == 'createParking') {
            $this->create($args[2]);                                                                                // Метод создания парковки
            echo 'Парковка вместимостью мест:' . $args[2] . ' создана';
            return true;
        }
        if ($args[1] == 'unpark') {
            $this->parkOut($args[2], $args[3]);                                                                     // Метод отпарковать ТС из парковки
            echo 'Авто c парковки(id): ' . $args[2] . ' ,VIN:' . $args[3] . ' отпарковано';
            return true;
        }
        if ($args[1] == 'getAllParking') {
            echo json_encode($this->loadAll()->getResponse());                                                     // Получение всех парковок
            return true;
        }
        if ($args[1] == 'getParking') {
            echo json_encode($this->load($args[2])->getResponse());                                                // Получение парковки по id
            return true;
        }
        if ($args[1] == 'deletePark') {
            $this->delete($args[2]);                                                                                // Метод удаления парковки
            echo 'Парковка с id: ' . $args[2] . ' удалена';
            return true;
        }
        return false;
    }
}
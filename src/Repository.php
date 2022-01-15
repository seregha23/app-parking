<?php

namespace App;


use App\Parking\Parking;

class Repository
{
    public string $path;

    // Создание пути хранения файлов для репозитория
    public function __construct(string $directory)
    {
        $this->path = __DIR__ . '/../' . $directory;
        if (!is_dir($this->path)) {
            mkdir($this->path);
        }
    }

    // Сохранение парковки в файл
    public function save(Parking $parking): bool
    {
        $idFile = $parking->id;
        $idsFiles = scandir($this->path, 0);
        foreach ($idsFiles as $file) {
            if ($file != '.' && $file != '..') {
                if ($file === $idFile) {
                    $idFile = substr(md5(mt_rand(0, 9)), 0, 4);;
                }
            }
        }
        $data = serialize($parking);
        $file = $this->path . '/' . $idFile . '.txt';
        return file_put_contents($file, $data);
    }

    // Загрузка парковки из файла по ID
    public function load(string $id): object
    {
        $parking = file_get_contents($this->path . '/' . $id . '.txt');
        if (!empty($parking)) {
            return unserialize($parking);
        }
        throw new \DomainException('Такой парковки нет');
    }

    // Загрузка всех парковок из файлов
    public function loadAll(): array
    {
        $allFiles = scandir($this->path, 0);
        $allParking = [];
        foreach ($allFiles as $file) {
            if ($file != '.' && $file != '..') {
                $parking = file_get_contents($this->path . '/' . $file);
                $allParking[] = unserialize($parking);
            }
        }
        return $allParking;
    }

    // Удаление парковки по ID
    public function delete(string $id): bool
    {
        return unlink($this->path . '/' . $id . '.txt');
    }

    // Получение следующего свободного ID
    public function getFreeId(): string
    {
        $randomId = substr(md5(mt_rand(0, 9)), 0, 4);
        $freeId = $randomId;
        // Проверка на наличие одинакового название файла
        $allFiles = scandir($this->path, 0);
        foreach ($allFiles as $file) {
            if ($file != '.' && $file != '..') {
                // удаляем расширение файла(.txt) для следующей проверки
                $file = preg_replace('/\..+/', '', $file);
                if ($file == $randomId) {
                    $freeId = substr(md5(mt_rand()), 0, 4);
                }
            }
        }
        return $freeId;
    }
}
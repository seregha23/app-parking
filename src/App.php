<?php

namespace App;

use App\Api;

class App
{
    protected Repository $repository;
    protected $argv;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->argv = $_SERVER["argv"];
    }
    // Запустить приложение
    public function run():bool
    {
        $api = new Api($this->repository);
        return $api->runApp(...$this->argv);
    }
}
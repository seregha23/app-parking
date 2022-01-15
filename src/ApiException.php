<?php

namespace App;

class ApiException extends \RuntimeException
{
    // Переопределим исключение так, что параметр message станет обязательным
    public function __construct($message, $code = 0, \RuntimeException $previous = null) {
        // убедитесь, что все передаваемые параметры верны
        parent::__construct($message, $code, $previous);
    }
}
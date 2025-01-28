<?php
namespace Exceptions;

class ApiException extends \Exception
{
    public function __construct($message, $code) {
        parent::__construct($message, $code);
    }
    public function getResponse() {
        return json_encode(['error' => $this->getMessage()]);
    }
}
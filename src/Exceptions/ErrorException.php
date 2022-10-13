<?php

namespace Vision\Exceptions;

use Exception;

class ErrorException extends Exception
{
    public function __construct($message, $code = 500)
    {
        require_once './errorpages/template.php';
    }
}

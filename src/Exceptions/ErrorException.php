<?php

namespace Vision\Exceptions;

use Exception;

class ErrorException extends Exception
{
    public function __construct($message, $code = 500)
    {
        $error = [
            'message' => $message,
            'code' => $code
        ];
        require_once 'errorpages/template.php';
    }
}

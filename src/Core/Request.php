<?php

namespace Vision\Core;


class Request
{

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        // 
    }

    public function capture(): Request
    {
        return $this; // For testing only atm
    }
}

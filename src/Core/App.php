<?php

namespace Vision\Core;

use Vision\Core\Request;


class App
{

    private static Request $request;

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        // 
    }

    public function prepare($path): App
    {
        static::$request = Request::capture();


        return $this;
    }

    public function getRequest(): Request
    {
        return static::$request ?: false;
    }

    public function build(): void
    {
        //
    }

    public static function getRootPath(): string
    {
        return dirname(__DIR__);
    }
}

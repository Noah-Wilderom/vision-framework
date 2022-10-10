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

    public function prepare($path)
    {
        static::$request = Request::capture();


        return $this;
    }

    public function getRequest()
    {
        return static::$request ?: false;
    }

    public function build()
    {
        //
    }

    public function getRootPath()
    {
        return dirname(__DIR__);
    }
}

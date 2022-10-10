<?php

namespace Vision\Core;

use Vision\Core\Request;


class App
{

    /**
     * @var Request request
     */
    private static Request $request;

    private static $basePath;

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        static::$basePath = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        static::$request = new Request();
    }

    public function prepare($path): App
    {
        static::$request = static::$request->capture();

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
        return static::$basePath;
    }
}

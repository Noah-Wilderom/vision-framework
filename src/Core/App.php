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
        // Define the absolute path off the project directory
        static::$basePath = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        // Initialize the Request
        static::$request = new Request();
    }

    public function prepare($path): App
    {
        // Capture the incoming request
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

    public static function getConfigPath(): string
    {
        return static::$basePath . DIRECTORY_SEPARATOR . 'config';
    }
}

<?php

namespace Vision\Core;

use Vision\Core\Request;
use Vision\Config;


class App
{

    /**
     * @var Request request
     */
    private static Request $request;

    private static $basePath;

    private static Config\Handler $config;

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        // Define the absolute path off the project directory
        static::$basePath = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
    }

    public function prepare($path): App
    {
        return $this;
    }

    public function getRequest(): Request
    {
        return static::$request ?: false;
    }

    public function build(): void
    {
        //Initialize the Config handler
        static::$config = new Config\Handler;

        // Initialize the Request
        static::$request = new Request();

        // Capture the incoming request
        static::$request = static::$request->capture();
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

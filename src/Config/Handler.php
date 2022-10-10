<?php

namespace Vision\Config;

use Dotenv\Dotenv;
use InvalidArgumentException;

class Handler
{

    protected static $env;

    public function __construct()
    {
        static::$env = static::initEnv();
    }

    public static function initEnv(): array
    {
        $dotenv = Dotenv::createImmutable(root_path());
        $dotenv->safeLoad();

        return static::setEnv();
    }

    private static function setEnv(): array
    {
        $env = $_ENV;
        $_ENV = false;

        foreach ($_SERVER as $key => $value)
        {
            if (isset($env[$key])) $_SERVER[$key] = null;
        }

        return $env;
    }

    public static function getEnv(string $item): mixed
    {
        return in_array($item, static::$env) ? static::$env[$item] : throw new InvalidArgumentException(sprintf('The "%s" environment variable could not be found.', $item));
    }
}

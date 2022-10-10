<?php

namespace Vision\Config;

use Dotenv\Dotenv;
use InvalidArgumentException;

class Handler
{

    protected static $env;
    protected static $dotEnvDriver;

    public function __construct()
    {
        static::$env = $this->initEnv();
    }

    public function initEnv(): array
    {
        self::$dotEnvDriver = Dotenv::createImmutable(root_path());
        self::$dotEnvDriver->safeLoad();

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
        return in_array($item, array_keys(static::$env)) ? static::$env[$item] : throw new InvalidArgumentException(sprintf('The "%s" environment variable could not be found.', $item));
    }
}

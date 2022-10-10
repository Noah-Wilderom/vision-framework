<?php

namespace Vision\Config;

use Dotenv\Dotenv;
use InvalidArgumentException;
use Vision\Helpers\Directory;
use Symfony\Component\Finder\Finder;

class Handler
{

    protected static $env;
    protected static $dotEnvDriver;

    protected static $config;

    public function __construct()
    {
        static::$env = $this->initEnv();
        static::$config = $this->initConfig();
    }

    private function initEnv(): array
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

    private function initConfig()
    {
        return $this->getConfigFiles();
    }

    public static function getConfig(string $item): mixed
    {
        return in_array($item, array_keys(static::$config)) ? static::$config[$item] : false;
    }

    private function getConfigFiles()
    {
        $files = [];

        $configPath = realpath(config_path());

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file)
        {
            $directory = Directory::getNestedDirectory($file, $configPath);

            $files[$directory . basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        ksort($files, SORT_NATURAL);

        return $files;
    }
}

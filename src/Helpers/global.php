<?php

use Vision\Config;
use Vision\Core\App;
use Vision\Helpers\Dumper;
use Vision\Collections\Collection;

if (!function_exists('app'))
{
    /**
     * Creates a app instance
     *
     * @return \Vision\Core\App
     */
    function app()
    {
        return new App();
    }
}

if (!function_exists('dump'))
{
    /**
     * Dumps the values
     *
     * @param mixed values
     * @return \Vision\Helpers\Dumper
     */
    function dump(...$values)
    {
        return new Dumper(...$values);
    }
}

if (!function_exists('root_path'))
{
    /**
     * Get the root path
     *
     * @return string path
     */
    function root_path()
    {
        return App::getRootPath();
    }
}

if (!function_exists('config_path'))
{
    /**
     * Get the config path
     *
     * @return string path
     */
    function config_path()
    {
        return App::getConfigPath();
    }
}

if (!function_exists('env'))
{
    /**
     * Get a env value
     *
     * @param string item
     * @return string env
     */
    function env(string $item)
    {
        return Config\Handler::getEnv($item);
    }
}

if (!function_exists('config'))
{
    /**
     * Get a config value
     *
     * @param string item
     * @return string config
     */
    function config(string $key = null)
    {
        return Config\Handler::getConfig($key);
    }
}

if (!function_exists('collect'))
{
    /**
     * Get a collect value
     *
     * @param string value
     * @return Collection
     */
    function collect($value = [])
    {
        return new Collection($value);
    }
}

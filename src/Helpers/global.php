<?php

use Vision\Core\App;
use Vision\Helpers\Dumper;

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

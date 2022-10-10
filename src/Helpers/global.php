<?php

use Vision\Core;
use Vision\Helpers\Dumper;

if (! function_exists('app')) {
    /**
     * Creates a app instance
     *
     * @return \Vision\Core
     */
    function app()
    {
        return new Core();
    }
}

if (! function_exists('dump')) {
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
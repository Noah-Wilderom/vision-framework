<?php

use Vision\Core;

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
<?php

namespace Vision\Facades;

use Vision\Http\Router;

class Route extends Facade
{
    public static function getFacadeAccessor()
    {
        return Router::class;
    }
}

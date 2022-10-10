<?php

namespace Vision\Config;

use Dotenv\Dotenv;

class Handler
{

    public function __construct()
    {
        $this->env = static::initEnv();
    }

    public static function initEnv(): void
    {
        $dotenv = Dotenv::createImmutable(root_path());
        $dotenv->safeLoad();
    }
}

<?php

namespace Vision\Config;

use Dotenv\Dotenv;

class Handler {

    public function __construct()
    {
        $this->env = static::initEnv();

    }

    public static function initEnv()
    {
        $dotenv = Dotenv::createImmutable(root_path());
        $dotenv->safeLoad();
    }
}
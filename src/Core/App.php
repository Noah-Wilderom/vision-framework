<?php

namespace Vision\Core;

use Vision\Config;
use ReflectionMethod;
use Vision\Core\Request;
use Vision\Facades\Route;
use Vision\Console\Kernel;


class App
{

    /**
     * @var Request request
     */
    private Request $request;

    private static $basePath;

    private static Config\Handler $config;

    private Kernel $kernel;

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        // Define the absolute path off the project directory
        static::$basePath = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
    }

    public function prepare($path): App
    {
        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request ?: false;
    }

    public function build(): void
    {
        //Initialize the Config handler
        static::$config = new Config\Handler;

        // Initialize the Request
        $this->request = new Request();

        $this->setRouting();
    }

    private function setRouting(): void
    {
        require root_path() . DIRECTORY_SEPARATOR . 'routes.php';

        $routes = Route::getRoutes()->toArray();
        $uri = $this->getURL();

        if (isset($routes[$uri]))
        {
            $route = $routes[$uri];

            $obj = new $route['controller'];

            $method = new ReflectionMethod($obj, $route['action']);
            foreach ($method->getParameters() as $arg)
            {
                if ($arg->getType() instanceof Route)
                {
                    $obj->{$route['action']}($this->request);
                }
            }

            $obj->{$route['action']}();
        }
    }

    public function buildKernel($args): void
    {
        //Initialize the Config handler
        static::$config = new Config\Handler;

        $this->kernel = new Kernel();

        array_shift($args);

        if (empty($args))
        {
            $this->kernel->help();
            return;
        }
    }

    public static function getRootPath(): string
    {
        return static::$basePath;
    }

    public static function getConfigPath(): string
    {
        return static::$basePath . DIRECTORY_SEPARATOR . 'config';
    }

    public function getURL()
    {
        if ($_SERVER['REQUEST_URI'])
        {
            $url = rtrim(strtolower($_SERVER['REQUEST_URI']), '/');
            // Filter de url van alles wat niet in een url thuishoort 
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url;
        }
    }
}

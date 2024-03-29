<?php

namespace Vision\Core;

use Vision\Config;
use ReflectionMethod;
use RuntimeException;
use Vision\Http\Router;
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

    public function build()
    {
        //Initialize the Config handler
        static::$config = new Config\Handler;

        // Initialize the Request
        $this->request = new Request();

        return $this->setRouting();
    }

    private function setRouting()
    {
        require root_path() . DIRECTORY_SEPARATOR . 'routes.php';

        $routes = Route::getRoutes()->toArray();
        $uri = $this->getURL();

        // print_r($routes);
        // print_r("<br>");

        if (isset($routes[$uri]))
        {
            $route = $routes[$uri];

            $obj = new $route['controller'];

            $method = new ReflectionMethod($obj, $route['method']);
            foreach ($method->getParameters() as $arg)
            {
                if ($arg->getType() instanceof Route)
                {
                    print_r('test route');
                    return $obj->{$route['method']}($this->request);
                }
            }

            return $obj->{$route['method']}();
        }

        abort(404);
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

    public static function getViewPath(): string
    {
        return static::$basePath . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;
    }

    public static function makeView($view, $attributes = [])
    {
        extract($attributes);

        require_once view_path() . $view . '.php';
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

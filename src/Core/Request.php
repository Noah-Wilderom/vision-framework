<?php

namespace Vision\Core;

class Request
{
    protected $request;

    protected static $requestBlacklist;

    public function __construct()
    {
        static::init();
        // Capture the current request
        $this->capture();
    }

    public static function init(): void
    {
        static::$requestBlacklist = config('http.blacklistedParams');
    }

    public static function addToRequestBlacklist(string $item): bool
    {
        return in_array($item, static::$requestBlacklist) ? (bool) static::$requestBlacklist[] = $item : false;
    }

    public function getGetRequest()
    {
        return collect($this->request->get('get'));
    }

    public function getPostRequest()
    {
        return collect($this->request->get('post'));
    }

    public function getServerRequest()
    {
        return collect($this->request->get('server'));
    }

    public function capture(): Request
    {
        return $this->captureCurrentRequest();
    }

    private function captureCurrentRequest(): Request
    {
        $request = collect();

        $request->add('server', array_map(
            function ($req, $value)
            {
                if (!in_array($req, static::$requestBlacklist)) return [$req => $value];
            },
            array_keys($_SERVER),
            array_values($_SERVER)
        ));

        $request->add('get', array_map(
            function ($req, $value)
            {
                if (!in_array($req, static::$requestBlacklist)) return [$req => $value];
            },
            array_keys($_GET),
            array_values($_GET)
        ));

        $request->add('post', array_map(
            function ($req, $value)
            {
                if (!in_array($req, static::$requestBlacklist)) return [$req => $value];
            },
            array_keys($_POST),
            array_values($_POST)
        ));

        $this->request = $request;

        return $this;
    }
}

<?php

namespace Vision\Core;

class Request
{
    protected $request;

    protected static $requestBlacklist;

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        static::$requestBlacklist = config('http.blacklistedParams');
    }

    public static function addToRequestBlacklist(string $item): bool
    {
        return in_array($item, static::$requestBlacklist) ? (bool) static::$requestBlacklist[] = $item : false;
    }

    public function capture(): Request
    {
        return $this->captureCurrentRequest();
    }

    private function captureCurrentRequest(): Request
    {
        $request = [];

        $request['server'] = array_map(function ($req, $value)
        {
            if (!in_array($req, static::$requestBlacklist)) return [$req => $value];
        }, array_keys($_SERVER), array_values($_SERVER));

        print_r($request);

        return $this;
    }
}

<?php

namespace App\Core;

class Request
{
    private $payload_data;

    /**
     * Fetch the request URI.
     *
     * @return string
     */
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );
    }

    /**
     * Fetch the request method.
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get($key)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
    }

    public function all()
    {
        return $_REQUEST;
    }

    public function has($key)
    {
        return isset($_REQUEST[$key]) ? TRUE : FALSE;
    }

    public function header($key)
    {
        return $_SERVER[strtoupper(str_replace("-", "_", $key))];
    }

    public function toJson()
    {
        return json_encode($this->all());
    }
}

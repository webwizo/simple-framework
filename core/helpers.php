<?php

use App\Core\App;
use App\Core\Libraries\Bcrypt;

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
function view($name, $data = [])
{
    extract($data);

    return require "app/views/{$name}.view.php";
}

/**
 * Redirect to a new page.
 *
 * @param  string $path
 */
function redirect($path)
{
    header("Location: /{$path}");
}

function bcrypt($string)
{
    return App::get('bcrypt')->hash_password($string);
}

function config($key)
{
    return App::get('config')[$key];
}

function check_hash($string, $hash)
{
    return App::get('bcrypt')->check_password($string, $hash);
}

function env($key, $default = null)
{
    return !empty(getenv($key)) ? getenv($key) : $default;
}

function request($key = null)
{
    $request = App::get('request');

    if ($key) {
        return $request->get($key);
    }

    return $request;
}

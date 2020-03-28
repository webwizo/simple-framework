<?php

namespace App\Core;

use Dotenv\Dotenv;

class Env
{
    protected $dotenv;

    public function __construct()
    {
        $this->dotenv = Dotenv::createMutable( dirname(__DIR__, 1) );
        $this->dotenv->load();
    }
}
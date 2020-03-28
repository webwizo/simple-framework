<?php

use App\Core\{App, Env, Request};
use App\Core\Libraries\Bcrypt;
use App\Core\Database\{QueryBuilder, Connection};

App::bind('loadenv', new Env());

App::bind('config', require 'config/app.php');

App::bind('request', new Request());

// App::bind('database', new QueryBuilder(
//     Connection::make(App::get('config')['database'])
// ));

App::bind('bcrypt', new Bcrypt());


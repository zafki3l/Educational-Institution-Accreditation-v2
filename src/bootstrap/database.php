<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher as IlluminateDispatcher;
use Illuminate\Container\Container;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $_ENV['MYSQL_HOST'],
    'database' => $_ENV['MYSQL_DATABASE'],
    'username' => $_ENV['MYSQL_USER'],
    'password' => $_ENV['MYSQL_PASSWORD'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
]);

$capsule->setEventDispatcher(new IlluminateDispatcher(new Container));

$capsule->setAsGlobal();
$capsule->bootEloquent();

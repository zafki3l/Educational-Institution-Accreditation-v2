<?php

use App\Shared\Infrastructure\MySQLDatabase;
use Core\App;
use Illuminate\Container\Container;

$container = new Container();

$container->singleton(PDO::class, function () {
    return (new MySQLDatabase())->connect();
});

$providers = require_once 'providers.php';

foreach ($providers as $provider) {
    $provider->register($container);
}

App::setContainer($container);
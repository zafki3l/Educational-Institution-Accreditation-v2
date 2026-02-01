<?php

use App\Infrastructure\Persistent\Databases\MySQLDatabase;
use Illuminate\Container\Container;

$container = new Container();

$container->singleton(PDO::class, function () {
    return (new MySQLDatabase())->connect();
});

return $container;
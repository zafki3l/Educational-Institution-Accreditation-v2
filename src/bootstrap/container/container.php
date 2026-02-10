<?php

use App\Shared\Infrastructure\MySQLDatabase;
use App\Shared\Logging\LoggerInterface;
use App\Shared\Logging\MongoLogger;
use Core\App;
use Illuminate\Container\Container;

$container = new Container();

$container->singleton(PDO::class, function () {
    return (new MySQLDatabase())->connect();
});

$container->bind(
    LoggerInterface::class,
    MongoLogger::class
);

$providers = require_once 'providers.php';

foreach ($providers as $provider) {
    $provider->register($container);
}

App::setContainer($container);
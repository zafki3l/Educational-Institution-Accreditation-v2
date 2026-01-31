<?php

use Core\container\App;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAttributes(true);

$builder->addDefinitions(__DIR__ . '/core.php');

$container = $builder->build();

App::setContainer($container);
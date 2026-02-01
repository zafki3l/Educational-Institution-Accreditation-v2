<?php

use Dotenv\Dotenv;

require dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

require_once 'database.php';

require_once 'container/container.php';

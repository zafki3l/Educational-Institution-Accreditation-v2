<?php

use App\Shared\Security\CsrfTokenGenerator;
use App\Shared\SessionManager\SessionGenerator;
use Dotenv\Dotenv;

require dirname(__DIR__, 2) . '/vendor/autoload.php';

SessionGenerator::generate();
CsrfTokenGenerator::generate();

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

require_once 'database.php';
require_once 'container/container.php';
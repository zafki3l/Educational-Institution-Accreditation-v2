<?php

use App\Presentation\Controller\HomeController;

$route->get('/', [HomeController::class, 'index']);
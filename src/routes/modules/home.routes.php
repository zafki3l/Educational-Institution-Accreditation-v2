<?php

use App\Modules\Home\Presentation\Controllers\HomeController;

$route->get('/', [HomeController::class, 'index']);
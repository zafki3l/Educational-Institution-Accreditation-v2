<?php

use App\Modules\Authentication\Presentation\Controllers\LoginController;
use App\Modules\Authentication\Presentation\Controllers\LogoutController;

$route->get('/login', [LoginController::class, 'showLogin']);
$route->post('/login', [LoginController::class, 'login']);
$route->post('/logout', [LogoutController::class, 'logout']);
<?php

use App\Modules\UserManagement\Presentation\Controllers\CreateUserController;
use App\Modules\UserManagement\Presentation\Controllers\IndexUserController;
use App\Modules\UserManagement\Presentation\Controllers\UpdateUserController;

$route->get('/users', [IndexUserController::class, 'index']);
$route->post('/users', [CreateUserController::class, 'store']);
$route->get('/user/{id}', [UpdateUserController::class, 'edit']);
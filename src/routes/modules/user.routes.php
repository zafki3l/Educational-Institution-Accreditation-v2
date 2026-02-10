<?php

use App\Modules\UserManagement\Presentation\Controllers\CreateUserController;
use App\Modules\UserManagement\Presentation\Controllers\IndexUserController;
use App\Modules\UserManagement\Presentation\Controllers\UpdateUserController;

$route->get('/users', [IndexUserController::class, 'index']);
$route->post('/users', [CreateUserController::class, 'store']);
$route->get('/users/{id}/edit', [UpdateUserController::class, 'edit']);
$route->put('/users/update', [UpdateUserController::class, 'update']);
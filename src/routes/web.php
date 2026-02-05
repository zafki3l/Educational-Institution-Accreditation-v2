<?php

use App\Modules\Home\Presentation\Controllers\HomeController;
use App\Modules\Role\Presentation\Controllers\RoleController;
use App\Modules\UserManagement\Presentation\Controllers\UserController;

$route->get('/', [HomeController::class, 'index']);

$route->get('/clickme', [HomeController::class, 'click']);

$route->post('/process', [HomeController::class, 'process']);

// Roles
$route->get('/roles', [RoleController::class, 'index']);
$route->post('/roles', [RoleController::class, 'store']);
$route->delete('/roles/{id}', [RoleController::class, 'destroy']);

// Users
$route->get('/users', [UserController::class, 'index']);
$route->get('/users/create', [UserController::class, 'create']);
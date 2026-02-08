<?php

use App\Modules\Authentication\Presentation\Controllers\LoginController;
use App\Modules\Authentication\Presentation\Controllers\LogoutController;
use App\Modules\Home\Presentation\Controllers\HomeController;
use App\Modules\Role\Presentation\Controllers\CreateRoleController;
use App\Modules\Role\Presentation\Controllers\DeleteRoleController;
use App\Modules\Role\Presentation\Controllers\IndexRoleController;
use App\Modules\UserManagement\Presentation\Controllers\CreateUserController;
use App\Modules\UserManagement\Presentation\Controllers\IndexUserController;
use App\Modules\UserManagement\Presentation\Controllers\UpdateUserController;

$route->get('/', [HomeController::class, 'index']);

$route->get('/login', [LoginController::class, 'showLogin']);
$route->post('/login', [LoginController::class, 'login']);
$route->post('/logout', [LogoutController::class, 'logout']);

// Roles
$route->get('/roles', [IndexRoleController::class, 'index']);
$route->post('/roles', [CreateRoleController::class, 'store']);
$route->delete('/roles/{id}', [DeleteRoleController::class, 'destroy']);

// Users
$route->get('/users', [IndexUserController::class, 'index']);
$route->get('/users/create', [CreateUserController::class, 'create']);
$route->post('/users', [CreateUserController::class, 'store']);
$route->get('/user/{id}', [UpdateUserController::class, 'edit']);
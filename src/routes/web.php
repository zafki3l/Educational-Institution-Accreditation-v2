<?php

use App\Modules\Authentication\Presentation\Controllers\LoginController;
use App\Modules\Authentication\Presentation\Controllers\LogoutController;
use App\Modules\Home\Presentation\Controllers\HomeController;
use App\Modules\Role\Presentation\Controllers\RoleController;
use App\Modules\UserManagement\Presentation\Controllers\UserController;

$route->get('/', [HomeController::class, 'index']);

$route->get('/login', [LoginController::class, 'showLogin']);
$route->post('/login', [LoginController::class, 'login']);
$route->post('/logout', [LogoutController::class, 'logout']);

// Roles
$route->get('/roles', [RoleController::class, 'index']);
$route->post('/roles', [RoleController::class, 'store']);
$route->delete('/roles/{id}', [RoleController::class, 'destroy']);

// Users
$route->get('/users', [UserController::class, 'index']);
$route->get('/users/create', [UserController::class, 'create']);
$route->post('/users', [UserController::class, 'store']);
$route->get('/user/{id}', [UserController::class, 'edit']);
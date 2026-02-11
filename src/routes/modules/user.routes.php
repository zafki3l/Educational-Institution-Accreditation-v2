<?php

use App\Modules\UserManagement\Presentation\Controllers\CreateUserController;
use App\Modules\UserManagement\Presentation\Controllers\DeleteUserController;
use App\Modules\UserManagement\Presentation\Controllers\IndexUserController;
use App\Modules\UserManagement\Presentation\Controllers\UpdateUserController;
use App\Shared\Middlewares\EnsureAuth;

$route->middleware([EnsureAuth::class])
    ->get('/users', [IndexUserController::class, 'index']);

$route->middleware([EnsureAuth::class])
    ->post('/users', [CreateUserController::class, 'store']);

$route->middleware([EnsureAuth::class])
    ->get('/users/{id}/edit', [UpdateUserController::class, 'edit']);

$route->middleware([EnsureAuth::class])
    ->put('/users/update', [UpdateUserController::class, 'update']);
    
$route->middleware([EnsureAuth::class])
    ->delete('/users/{id}', [DeleteUserController::class, 'destroy']);
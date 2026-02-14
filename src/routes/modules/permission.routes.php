<?php

use App\Modules\Authorization\Presentation\Controllers\Permission\CreatePermissionController;
use App\Modules\Authorization\Presentation\Controllers\Permission\DeletePermissionController;
use App\Modules\Authorization\Presentation\Controllers\Permission\IndexPermissionController;
use App\Modules\Authorization\Presentation\Controllers\Role\IndexRoleController;
use App\Shared\Middlewares\EnsureAdmin;
use App\Shared\Middlewares\EnsureAuth;

$route->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/permissions', [IndexPermissionController::class, 'index']);

$route->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->post('/permissions', [CreatePermissionController::class, 'store']);

$route->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->delete('/permissions/{id}', [DeletePermissionController::class, 'destroy']);

$route->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/assign-permission', [IndexRoleController::class, 'assign']);
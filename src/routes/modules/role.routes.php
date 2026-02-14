<?php

use App\Modules\Authorization\Presentation\Controllers\Role\CreateRoleController;
use App\Modules\Authorization\Presentation\Controllers\Role\DeleteRoleController;
use App\Modules\Authorization\Presentation\Controllers\Role\IndexRoleController;
use App\Shared\Middlewares\EnsureAuth;

$route->middleware([EnsureAuth::class])
    ->get('/roles', [IndexRoleController::class, 'index']);

$route->middleware([EnsureAuth::class])
    ->post('/roles', [CreateRoleController::class, 'store']);
    
$route->middleware([EnsureAuth::class])
    ->delete('/roles/{id}', [DeleteRoleController::class, 'destroy']);
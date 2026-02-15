<?php

use App\Modules\DepartmentManagement\Presentation\Controllers\CreateDepartmentController;
use App\Modules\DepartmentManagement\Presentation\Controllers\IndexDepartmentController;
use App\Shared\Middlewares\EnsureAdmin;
use App\Shared\Middlewares\EnsureAuth;

$route->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/departments', [IndexDepartmentController::class, 'index']);

$route->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->post('/departments', [CreateDepartmentController::class, 'store']);
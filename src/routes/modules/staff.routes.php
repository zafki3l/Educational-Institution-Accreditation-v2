<?php

use App\Modules\StaffManagement\Presentation\Controllers\IndexStaffController;
use App\Shared\Middlewares\EnsureAdmin;
use App\Shared\Middlewares\EnsureAuth;

$route->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/staffs', [IndexStaffController::class, 'index']);
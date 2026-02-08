<?php

use App\Modules\Dashboard\Presentation\Controllers\AdminDashboardController;
use App\Modules\Dashboard\Presentation\Controllers\StaffDashboardController;

$route->get('/admin/dashboard', [AdminDashboardController::class, 'dashboard']);
$route->get('/staff/dashboard', [StaffDashboardController::class, 'dashboard']);

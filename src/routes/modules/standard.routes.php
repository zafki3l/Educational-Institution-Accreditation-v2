<?php

use App\Modules\QualityAssessment\Presentation\Controllers\Standard\CreateStandardController;
use App\Modules\QualityAssessment\Presentation\Controllers\Standard\IndexStandardController;
use App\Shared\Middlewares\EnsureAuth;
use App\Shared\Middlewares\EnsureStaff;

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/standards', [IndexStandardController::class, 'index']);

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/standards/create', [CreateStandardController::class, 'create']);

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->post('/standards', [CreateStandardController::class, 'store']);
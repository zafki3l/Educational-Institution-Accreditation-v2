<?php

use App\Modules\QualityAssessment\Presentation\Controllers\Criteria\CreateCriteriaController;
use App\Modules\QualityAssessment\Presentation\Controllers\Criteria\DeleteCriteriaController;
use App\Modules\QualityAssessment\Presentation\Controllers\Criteria\IndexCriteriaController;
use App\Shared\Middlewares\EnsureAuth;
use App\Shared\Middlewares\EnsureStaff;

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/criterias', [IndexCriteriaController::class, 'index']);

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->post('/criterias', [CreateCriteriaController::class, 'store']);

$route->middleware([EnsureAuth::class, EnsureStaff::class])
    ->delete('/criterias/{id}', [DeleteCriteriaController::class, 'destroy']);
<?php

use App\Modules\Role\Presentation\Controllers\CreateRoleController;
use App\Modules\Role\Presentation\Controllers\DeleteRoleController;
use App\Modules\Role\Presentation\Controllers\IndexRoleController;

$route->get('/roles', [IndexRoleController::class, 'index']);
$route->post('/roles', [CreateRoleController::class, 'store']);
$route->delete('/roles/{id}', [DeleteRoleController::class, 'destroy']);
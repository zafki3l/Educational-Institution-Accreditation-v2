<?php

namespace App\Modules\DepartmentManagement\Presentation\Controllers;

use App\Modules\DepartmentManagement\Presentation\Requests\CreateDepartmentRequest;

final class CreateDepartmentController extends DepartmentController
{
    public function store(CreateDepartmentRequest $request): void
    {
        print_r($request);
    }
}
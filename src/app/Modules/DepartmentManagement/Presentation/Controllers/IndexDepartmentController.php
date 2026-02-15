<?php

namespace App\Modules\DepartmentManagement\Presentation\Controllers;

use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexDepartmentController extends DepartmentController
{
    public function __construct(private DepartmentReaderInterface $departmentReader) {}

    public function index(): ViewResponse
    {
        $departments = $this->departmentReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'index/main',
            'main.layouts',
            [
                'title' => 'Quản lý phòng ban | ' . SYSTEM_NAME,
                'departments' => $departments
            ]
        );
    }
}
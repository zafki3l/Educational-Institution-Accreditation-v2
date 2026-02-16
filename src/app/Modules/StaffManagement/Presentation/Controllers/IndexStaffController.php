<?php

namespace App\Modules\StaffManagement\Presentation\Controllers;

use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Application\Contracts\UserReader\UserReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexStaffController extends StaffController
{
    public function __construct(
        private DepartmentReaderInterface $departmentReader,
        private UserReaderInterface $userReader
    ) {}

    public function index(): ViewResponse
    {
        $results = $this->userReader->all(null, null);
                
        $departments = $this->departmentReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'index/main',
            'main.layouts',
            [
                'title' => 'Quản lý nhân viên | ' . SYSTEM_NAME,
                'departments' => $departments,
                'users' => $results->items,
                'pagination' => $results
            ]
        );
    }
}
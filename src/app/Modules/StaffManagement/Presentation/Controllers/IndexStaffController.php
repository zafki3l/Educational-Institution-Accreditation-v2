<?php

namespace App\Modules\StaffManagement\Presentation\Controllers;

use App\Modules\UserManagement\Infrastructure\Models\User;
use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Response\ViewResponse;

final class IndexStaffController extends StaffController
{
    public function __construct(private DepartmentReaderInterface $departmentReader) {}

    public function index(): ViewResponse
    {
        $staffs = User::with('role')
                    ->where('role_id', 2)
                    ->get();
                
        $departments = $this->departmentReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'index/main',
            'main.layouts',
            [
                'title' => 'Quản lý nhân viên | ' . SYSTEM_NAME,
                'departments' => $departments,
                'staffs' => $staffs
            ]
        );
    }
}
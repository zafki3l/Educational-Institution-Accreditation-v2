<?php

namespace App\Modules\Dashboard\Presentation\Controllers;

use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Application\Contracts\RoleReader\RoleReaderInterface;
use App\Shared\Application\Contracts\UserReader\UserReaderInterface;
use App\Shared\Domain\UserRole;
use App\Shared\Response\ViewResponse;

final class AdminDashboardController extends DashboardController
{
    public function __construct(
        private UserReaderInterface $userReader,
        private DepartmentReaderInterface $departmentReader,
        private RoleReaderInterface $roleReader
    ) {}

    public function dashboard(): ViewResponse
    {
        $total_users = $this->userReader->count();
        $total_staffs = $this->userReader->countByRoleId(UserRole::ROLE_STAFF);
        $total_departments = $this->departmentReader->count();
        $total_roles = $this->roleReader->count();
        
        return new ViewResponse(
            self::MODULE_NAME,
            'admin-dashboard/main',
            'main.layouts',
            [
                'title' => 'Trang điều khiển admin | ' . SYSTEM_NAME,
                'total_users' => $total_users,
                'total_staffs' => $total_staffs,
                'total_departments' => $total_departments,
                'total_roles' => $total_roles
            ]
        );
    }
}
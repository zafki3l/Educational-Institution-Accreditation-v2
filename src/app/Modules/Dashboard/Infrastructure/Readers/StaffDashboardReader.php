<?php

namespace App\Modules\Dashboard\Infrastructure\Readers;

use App\Modules\Dashboard\Application\Readers\StaffDashboardReaderInterface;
use App\Modules\Dashboard\Application\Responses\FirstCriteriaIdResponse;
use App\Modules\Dashboard\Application\Responses\StaffInfoResponse;
use App\Modules\Dashboard\Application\Responses\StandardManagementStatsResponse;
use App\Modules\DepartmentManagement\Infrastructure\Models\Department;
use App\Modules\QualityAssessment\Infrastructure\Models\Evidence;
use App\Modules\QualityAssessment\Infrastructure\Models\Milestone;
use App\Modules\UserManagement\Infrastructure\Models\User;
use App\Shared\Application\Contracts\CriteriaReader\CriteriaReaderInterface;
use App\Shared\Application\Contracts\StandardReader\StandardReaderInterface;

class StaffDashboardReader implements StaffDashboardReaderInterface
{
    public function __construct(
        private StandardReaderInterface $standardReader,
        private CriteriaReaderInterface $criteriaReader,
    ) {}

    public function getStaffInfo(string $staff_id): ?StaffInfoResponse
    {
        $staff = $staff_id ? User::with('department')->find($staff_id) : null;

        if (!$staff) {
            return null;
        }

        return new StaffInfoResponse(
            $staff->id,
            $staff->first_name,
            $staff->last_name,
            $staff->email,
            $staff->department->id,
            $staff->department->name
        );
    }

    public function getOverviewStandardManagementStats(): StandardManagementStatsResponse
    {
        return new StandardManagementStatsResponse(
            $this->standardReader->count(),
            $this->criteriaReader->count(),
            Milestone::count(),
            Evidence::count()
        );
    }

    public function getFirstCriteriaId(string $department_id): FirstCriteriaIdResponse
    {
        $department = (isStaff()) 
            ? Department::with('standards.criteria')->findOrFail($department_id)
            : '';

        $first_criteria = (isStaff()) ? $department->standards->first()?->criteria->first() : '';

        return new FirstCriteriaIdResponse(
            isAdmin() ? '1.1' : $first_criteria->id
        );
    }
}

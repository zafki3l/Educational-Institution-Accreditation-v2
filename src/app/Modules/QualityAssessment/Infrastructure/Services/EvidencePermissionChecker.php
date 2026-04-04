<?php

namespace App\Modules\QualityAssessment\Infrastructure\Services;

use App\Modules\QualityAssessment\Domain\Services\EvidencePermissionCheckerInterface;
use App\Modules\QualityAssessment\Infrastructure\Models\Criteria;
use App\Modules\UserManagement\Infrastructure\Models\User;

final class EvidencePermissionChecker implements EvidencePermissionCheckerInterface
{
    public function check(string $criteria_id, string $actor_id): bool
    {
        $standard = Criteria::with('standard')->findOrFail($criteria_id)->standard;
        $user = User::select('department_id')->where('id', $actor_id)->first();

        return isAdmin() || $standard->department_id === $user->department_id;
    }
}
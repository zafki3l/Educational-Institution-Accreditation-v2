<?php

namespace App\Modules\QualityAssessment\Application\Requests\MilestoneEvidence;

interface CreateMilestoneEvidenceRequestInterface
{
    public function getEvidenceId(): string;

    public function getCriteriaId(): string;

    public function getMilestoneId(): int;
}
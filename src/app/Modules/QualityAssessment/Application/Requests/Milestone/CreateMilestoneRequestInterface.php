<?php

namespace App\Modules\QualityAssessment\Application\Requests\Milestone;

interface CreateMilestoneRequestInterface
{
    public function getOrder(): string;

    public function getCriteriaId(): string;

    public function getName(): string;
}
<?php

namespace App\Modules\QualityAssessment\Presentation\Requests\Milestone;

use App\Modules\QualityAssessment\Application\Requests\Milestone\CreateMilestoneRequestInterface;

final class CreateMilestoneRequest implements CreateMilestoneRequestInterface
{
    private string $order;
    private string $criteria_id;
    private string $name;

    public function __construct()
    {
        $this->order = trim($_POST['order']);
        $this->criteria_id = trim($_POST['criteria_id']);
        $this->name = trim($_POST['name']);
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function getCriteriaId(): string
    {
        return $this->criteria_id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

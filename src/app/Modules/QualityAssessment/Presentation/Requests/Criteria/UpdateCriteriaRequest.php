<?php

namespace App\Modules\QualityAssessment\Presentation\Requests\Criteria;

use App\Modules\QualityAssessment\Application\Requests\Criteria\UpdateCriteriaRequestInterface;

final class UpdateCriteriaRequest implements UpdateCriteriaRequestInterface
{
    private string $id;
    private string $name;

    public function __construct()
    {
        $this->id = $_POST['id'];
        $this->name = trim($_POST['name']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
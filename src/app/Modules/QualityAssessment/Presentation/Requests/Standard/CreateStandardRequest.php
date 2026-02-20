<?php

namespace App\Modules\QualityAssessment\Presentation\Requests\Standard;

use App\Modules\QualityAssessment\Application\Requests\Standard\CreateStandardRequestInterface;

final class CreateStandardRequest implements CreateStandardRequestInterface
{
    private string $id;
    private string $name;
    private string $department_id;

    public function __construct()
    {
        $this->id = $_POST['id'];
        $this->name = $_POST['name'];
        $this->department_id = $_POST['department_id'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDepartmentId(): string
    {
        return $this->department_id;
    }
}

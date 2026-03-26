<?php

namespace App\Modules\QualityAssessment\Application\Readers;

interface EvidenceReaderInterface
{
    public function count(): int;

    public function countByDepartment(string $department_id): int;
}
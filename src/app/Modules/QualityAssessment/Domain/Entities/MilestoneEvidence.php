<?php

namespace App\Modules\QualityAssessment\Domain\Entities;

use App\Modules\QualityAssessment\Domain\ValueObjects\Evidence\EvidenceId;

class MilestoneEvidence
{
    private function __construct(
        private EvidenceId $evidence_id,
        private int $milestone_id
    ) {
        $this->evidence_id = $evidence_id;
        $this->milestone_id = $milestone_id;
    }

    public static function create(EvidenceId $evidence_id, int $milestone_id)
    {
        return new self($evidence_id, $milestone_id);
    }

    public function getEvidenceId(): EvidenceId
    {
        return $this->evidence_id;
    }

    public function getMilestoneId(): int
    {
        return $this->milestone_id;
    }
}

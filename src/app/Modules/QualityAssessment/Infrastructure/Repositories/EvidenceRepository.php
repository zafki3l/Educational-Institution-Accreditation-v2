<?php

namespace App\Modules\QualityAssessment\Infrastructure\Repositories;

use App\Modules\QualityAssessment\Domain\Entities\Evidence as EntitiesEvidence;
use App\Modules\QualityAssessment\Domain\Repositories\EvidenceRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Models\Evidence as ModelsEvidence;
use App\Modules\QualityAssessment\Infrastructure\Models\MilestoneEvidence;

class EvidenceRepository implements EvidenceRepositoryInterface
{
    public function create(EntitiesEvidence $e): void
    {
        ModelsEvidence::create([
            'id' => $e->getId()->value(),
            'name' => $e->getName(),
            'milestone_id' => $e->getMilestoneId(),
            'document_number' => $e->getDocumentNumber() ?: null,
            'issued_date' => $e->getIssuedDate()?->format('Y-m-d'),
            'issuing_authority' => $e->getIssuingAuthority(),
            'file_url' => $e->getFileUrl()
        ]);
    }

    public function delete(string $id): string
    {
        $evidence = ModelsEvidence::with('milestone.criteria')
            ->findOrFail($id);

        $criteriaId = $evidence->milestone->criteria->id;

        MilestoneEvidence::where('evidence_id', $id)->delete();

        $evidence->delete();

        return $criteriaId;
    }

    public function update(EntitiesEvidence $entitiesEvidence): string
    {
        $evidence = ModelsEvidence::with('milestone.criteria')
            ->findOrFail($entitiesEvidence->getId()->value());

        $data = [
            'name' => $entitiesEvidence->getName(),
            'document_number' => $entitiesEvidence->getDocumentNumber() ?: null,
            'issued_date' => $entitiesEvidence->getIssuedDate()?->format('Y-m-d'),
            'issuing_authority' => $entitiesEvidence->getIssuingAuthority()
        ];

        if ($entitiesEvidence->getFileUrl()) {
            $data['file_url'] = $entitiesEvidence->getFileUrl();
        }

        $evidence->update($data);

        return $evidence->milestone->criteria->id;
    }

    public function attachMilestone(string $evidenceId, string $milestoneId): void
    {
        MilestoneEvidence::create([
            'evidence_id' => $evidenceId,
            'milestone_id' => $milestoneId
        ]);
    }
}
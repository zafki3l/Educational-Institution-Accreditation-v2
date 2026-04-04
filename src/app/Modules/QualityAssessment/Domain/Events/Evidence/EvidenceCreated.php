<?php

namespace App\Modules\QualityAssessment\Domain\Events\Evidence;

final class EvidenceCreated
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $document_number,
        public readonly ?string $issued_date,
        public readonly string $issuing_authority,
        public readonly string $milestone_code,
        public readonly ?string $file_url,
        public readonly string $actor_id
    ) {}
}
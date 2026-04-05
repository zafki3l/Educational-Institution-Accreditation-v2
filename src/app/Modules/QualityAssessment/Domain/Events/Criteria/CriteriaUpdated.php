<?php

namespace App\Modules\QualityAssessment\Domain\Events\Criteria;

final class CriteriaUpdated
{
    public function __construct(
       public readonly string $id,
       public readonly array $changes,
       public readonly string $actor_id 
    ) {}
}
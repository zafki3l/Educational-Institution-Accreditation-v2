<?php

namespace App\Modules\QualityAssessment\Domain\Exception\Evidence;

use App\Shared\Exception\DomainException;

final class EvidenceEmptyIssuedDateException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            'Ngày ban hành không được bỏ trống!',
            'EVIDENCE_ISSUED_DATE_EMPTY'
        );
    }
}


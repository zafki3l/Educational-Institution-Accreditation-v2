<?php

namespace App\Modules\QualityAssessment\Domain\Entities;

class Evidence
{
    private function __construct(
        private string $id,
        private string $name,
        private string $document_number,
        private string $issued_date,
        private string $issuing_authority,
        private string $file_url
    ) {}

    public static function create(
        string $id,
        string $name,
        string $document_number,
        string $issued_date,
        string $issuing_authority,
        string $file_url
    ): self {
        return new self($id, $name, $document_number, $issued_date, $issuing_authority, $file_url);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDocumentNumber(): string
    {
        return $this->document_number;
    }

    public function getIssuedDate(): string
    {
        return $this->issued_date;
    }

    public function getIssuingAuthority(): string
    {
        return $this->issuing_authority;
    }

    public function getFileUrl(): string
    {
        return $this->file_url;
    }
}
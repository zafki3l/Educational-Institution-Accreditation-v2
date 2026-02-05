<?php

namespace App\Modules\UserManagement\Domain\ValueObjects;

class Password
{
    private string $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public static function fromPlain(string $plain): self
    {
        return new self(password_hash($plain, PASSWORD_DEFAULT));
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function verify(string $plain): bool
    {
        return password_verify($plain, $this->hash);
    }

    public function value(): string
    {
        return $this->hash;
    }
}
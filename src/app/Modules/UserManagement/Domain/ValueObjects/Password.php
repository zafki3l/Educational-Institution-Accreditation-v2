<?php

namespace App\Modules\UserManagement\Domain\ValueObjects;

use App\Modules\UserManagement\Domain\Exception\PasswordEmptyException;
use App\Modules\UserManagement\Domain\Exception\PasswordInvalidFormatException;
use App\Modules\UserManagement\Domain\Exception\PasswordTooShortException;

class Password
{
    private const MINIMIUM_LENGTH = 8;

    private string $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public static function fromPlain(string $plain): self
    {
        $plain = trim($plain);

        self::checkEmpty($plain);
        
        self::checkMinimiumLength($plain);

        self::checkPasswordContainsCharacterAndNumber($plain);

        return new self(password_hash($plain, PASSWORD_DEFAULT));
    }

    private static function checkEmpty(string $plain): void
    {
        if (empty($plain)) {
            throw new PasswordEmptyException();
        }
    }

    private static function checkMinimiumLength(string $plain): void
    {
        if (strlen($plain) < self::MINIMIUM_LENGTH) {
            throw new PasswordTooShortException();
        }
    }

    private static function checkPasswordContainsCharacterAndNumber(string $plain)
    {
        if (!preg_match('/[A-Za-z]/', $plain) || !preg_match('/\d/', $plain)) {
            throw new PasswordInvalidFormatException();
        }
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
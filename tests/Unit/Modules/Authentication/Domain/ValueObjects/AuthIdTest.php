<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\Authentication\Domain\ValueObjects;

use App\Modules\Authentication\Domain\ValueObjects\AuthId;
use PHPUnit\Framework\TestCase;

class AuthIdTest extends TestCase
{
    public function testGenerateReturnString(): void
    {
        $authId = AuthId::generate();

        $this->assertIsString($authId->value());
    }

    public function testGenerateNotEmpty(): void
    {
        $authId = AuthId::generate();

        $this->assertNotEmpty($authId->value());
    }
}
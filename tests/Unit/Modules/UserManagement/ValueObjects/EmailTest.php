<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\UserManagement\ValueObjects;

use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\Exception\InvalidEmailFormatException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testCreateValidEmail(): void
    {
        $email = Email::fromString('user@example.com');

        $this->assertInstanceOf(Email::class, $email);
    }

    public function testEmailValueReturnsString(): void
    {
        $email = Email::fromString('user@example.com');

        $this->assertIsString($email->value());
    }

    public function testEmailValueReturnsCorrectValue(): void
    {
        $emailAddress = 'user@example.com';

        $email = Email::fromString($emailAddress);

        $this->assertEquals($emailAddress, $email->value());
    }

    public function testEmailIsConvertedToLowercase(): void
    {
        $email = Email::fromString('USER@EXAMPLE.COM');

        $this->assertEquals('user@example.com', $email->value());
    }

    public function testEmailIsTrimmed(): void
    {
        $email = Email::fromString('  user@example.com  ');

        $this->assertEquals('user@example.com', $email->value());
    }

    public function testInvalidEmailFormatThrowsException(): void
    {
        $this->expectException(InvalidEmailFormatException::class);

        Email::fromString('invalid-email');
    }

    public function testEmailWithoutAtSymbolThrowsException(): void
    {
        $this->expectException(InvalidEmailFormatException::class);

        Email::fromString('userexample.com');
    }

    public function testEmailWithoutDomainThrowsException(): void
    {
        $this->expectException(InvalidEmailFormatException::class);

        Email::fromString('user@');
    }

    public function testEmailWithoutLocalPartThrowsException(): void
    {
        $this->expectException(InvalidEmailFormatException::class);

        Email::fromString('@example.com');
    }

    public function testTwoEmailsWithSameValueAreEqual(): void
    {
        $email1 = Email::fromString('user@example.com');
        $email2 = Email::fromString('user@example.com');

        $this->assertTrue($email1->equals($email2));
    }

    public function testTwoEmailsWithDifferentValuesAreNotEqual(): void
    {
        $email1 = Email::fromString('user1@example.com');
        $email2 = Email::fromString('user2@example.com');

        $this->assertFalse($email1->equals($email2));
    }

    public function testEmailEqualityIsCaseSensitive(): void
    {
        $email1 = Email::fromString('USER@EXAMPLE.COM');
        $email2 = Email::fromString('user@example.com');

        // Both are converted to lowercase, so they should be equal
        $this->assertTrue($email1->equals($email2));
    }
}

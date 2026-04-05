<?php

namespace Tests\Unit\Modules\UserManagement\Domain\ValueObjects;

use App\Modules\UserManagement\Domain\ValueObjects\Email;
use App\Modules\UserManagement\Domain\Exception\InvalidEmailFormatException;
use App\Modules\UserManagement\Domain\Exception\EmailEmptyException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testCanBeCreatedFromAValidEmailString(): void
    {
        $emailString = '  USER@Example.com  ';
        $email = Email::fromString($emailString);

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals('user@example.com', $email->value());
    }

    public function testCanBeComparedForEquality(): void
    {
        $email1 = Email::fromString('test@example.com');
        $email2 = Email::fromString('TEST@example.com');
        $email3 = Email::fromString('other@example.com');

        $this->assertTrue($email1->equals($email2));
        $this->assertFalse($email1->equals($email3));
    }

    public function testThrowsExceptionWhenEmailIsEmpty(): void
    {
        $this->expectException(EmailEmptyException::class);
        Email::fromString('   ');
    }

    #[DataProvider('invalidEmailFormatProvider')]
    public function testFailsValidationForVariousInvalidFormats(string $invalidEmail): void
    {
        $this->expectException(InvalidEmailFormatException::class);
        Email::fromString($invalidEmail);
    }

    public static function invalidEmailFormatProvider(): array
    {
        return [
            ['plainaddress'],
            ['#@%^%#$@#$@#.com'],
            ['@example.com'],
            ['Joe Smith <email@example.com>'],
            ['email.example.com'],
            ['email@example@example.com'],
            ['.email@example.com'],
        ];
    }
}
<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\UserManagement\ValueObjects;

use App\Modules\UserManagement\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testGenerateReturnsValidUuid(): void
    {
        $userId = UserId::generate();

        $this->assertIsString($userId->value());
    }

    public function testGenerateNotEmpty(): void
    {
        $userId = UserId::generate();

        $this->assertNotEmpty($userId->value());
    }

    public function testGenerateFollowsUuidV4Format(): void
    {
        $userId = UserId::generate();

        $this->assertTrue(UserId::isValid($userId->value()));
    }

    public function testFromStringWithValidUuid(): void
    {
        $validUuid = '550e8400-e29b-41d4-a716-446655440000';

        $userId = UserId::fromString($validUuid);

        $this->assertIsString($userId->value());
    }

    public function testFromStringWithInvalidUuidThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid UUID");

        UserId::fromString('invalid-uuid');
    }

    public function testFromStringConvertToLowercase(): void
    {
        $upperUuid = '550E8400-E29B-41D4-A716-446655440000';

        $userId = UserId::fromString($upperUuid);

        $this->assertEquals(strtolower($upperUuid), $userId->value());
    }

    public function testTwoUserIdsWithSameValueAreEqual(): void
    {
        $uuid = '550e8400-e29b-41d4-a716-446655440000';

        $userId1 = UserId::fromString($uuid);
        $userId2 = UserId::fromString($uuid);

        $this->assertTrue($userId1->equals($userId2));
    }

    public function testTwoUserIdsWithDifferentValuesAreNotEqual(): void
    {
        $uuid1 = '550e8400-e29b-41d4-a716-446655440000';
        $uuid2 = '550e8400-e29b-41d4-a716-446655440001';

        $userId1 = UserId::fromString($uuid1);
        $userId2 = UserId::fromString($uuid2);

        $this->assertFalse($userId1->equals($userId2));
    }

    public function testIsValidWithValidUuid(): void
    {
        $validUuid = '550e8400-e29b-41d4-a716-446655440000';

        $this->assertTrue(UserId::isValid($validUuid));
    }

    public function testIsValidWithInvalidFormat(): void
    {
        $invalidUuid = 'not-a-uuid';

        $this->assertFalse(UserId::isValid($invalidUuid));
    }

    public function testIsValidWithWrongVersion(): void
    {
        // UUID v1 instead of v4
        $invalidUuid = '550e8400-e29b-11d4-a716-446655440000';

        $this->assertFalse(UserId::isValid($invalidUuid));
    }
}

<?php

namespace Tests\Modules\Authorization\Domain\Entities;

use App\Modules\Authorization\Domain\Entities\Role;
use App\Modules\Authorization\Domain\Exception\EmptyRoleNameException;
use App\Modules\Authorization\Domain\Exception\RoleIdExistsException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RoleTest extends TestCase
{
    private const DEFAULT_NAME = 'Editor';

    public function testInitializationWithValidData(): void
    {
        $role = Role::create(self::DEFAULT_NAME);

        $this->assertNull($role->getId());
        $this->assertSame(self::DEFAULT_NAME, $role->getName());
    }

    public function testAssignIdSuccess(): void
    {
        $role = Role::create(self::DEFAULT_NAME);
        
        $role->assignId(Role::ROLE_ADMIN);

        $this->assertSame(Role::ROLE_ADMIN, $role->getId());
    }

    public function testAssignIdThrowsExceptionWhenAlreadyAssigned(): void
    {
        $role = Role::create(self::DEFAULT_NAME);
        $role->assignId(Role::ROLE_USER);

        $this->expectException(RoleIdExistsException::class);
        
        $role->assignId(Role::ROLE_STAFF);
    }

    #[DataProvider('provideInvalidNames')]
    public function testCreateThrowsExceptionForInvalidNames(string $invalidName): void
    {
        $this->expectException(EmptyRoleNameException::class);
        
        Role::create($invalidName);
    }

    public function testRenameSuccess(): void
    {
        $role = Role::create('Old Name');
        $newName = 'New Modern Name';

        $role->rename($newName);

        $this->assertSame($newName, $role->getName());
    }

    #[DataProvider('provideInvalidNames')]
    public function testRenameThrowsExceptionForInvalidNames(string $invalidName): void
    {
        $role = Role::create(self::DEFAULT_NAME);

        $this->expectException(EmptyRoleNameException::class);
        
        $role->rename($invalidName);
    }

    public static function provideInvalidNames(): array
    {
        return [
            'empty string' => [''],
        ];
    }
}
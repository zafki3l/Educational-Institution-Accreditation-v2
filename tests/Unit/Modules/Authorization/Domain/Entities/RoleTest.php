<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\Authorization\Domain\Entities;

use App\Modules\Authorization\Domain\Entities\Role;
use App\Modules\Authorization\Domain\Exception\EmptyRoleNameException;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testCreateValidRole(): void
    {
        $name = 'Administrator';

        $role = Role::create($name);

        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals($name, $role->getName());
        $this->assertNull($role->getId());
    }

    public function testCreateRoleWithoutIdAssignment(): void
    {
        $role = Role::create('User');

        $this->assertNull($role->getId());
    }

    public function testAssignIdToRole(): void
    {
        $role = Role::create('Editor');
        $roleId = 123;

        $role->assignId($roleId);

        $this->assertEquals($roleId, $role->getId());
    }

    public function testAssignIdToRoleWithMultipleRoles(): void
    {
        $role1 = Role::create('Admin');
        $role2 = Role::create('User');

        $role1->assignId(1);
        $role2->assignId(2);

        $this->assertEquals(1, $role1->getId());
        $this->assertEquals(2, $role2->getId());
    }

    public function testAssignIdTwiceThrowsException(): void
    {
        $role = Role::create('Manager');
        $role->assignId(1);

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('ID already assigned');

        $role->assignId(2);
    }

    public function testCreateRoleWithEmptyNameThrowsException(): void
    {
        $this->expectException(EmptyRoleNameException::class);
        $this->expectExceptionMessage('Không được bỏ trống role name!');

        Role::create('');
    }

    public function testGetNameReturnsCorrectName(): void
    {
        $name = 'Super Admin';
        $role = Role::create($name);

        $this->assertEquals($name, $role->getName());
    }

    public function testGetIdReturnsNullBeforeAssignment(): void
    {
        $role = Role::create('Moderator');

        $this->assertNull($role->getId());
    }

    public function testGetIdReturnsCorrectIdAfterAssignment(): void
    {
        $role = Role::create('Guest');
        $role->assignId(99);

        $this->assertEquals(99, $role->getId());
    }

    public function testCreateMultipleRolesWithDifferentNames(): void
    {
        $role1 = Role::create('Admin');
        $role2 = Role::create('User');
        $role3 = Role::create('Guest');

        $this->assertNotEquals($role1->getName(), $role2->getName());
        $this->assertNotEquals($role2->getName(), $role3->getName());
    }

    public function testAssignIdWithDifferentValues(): void
    {
        $role1 = Role::create('Role1');
        $role2 = Role::create('Role2');
        $role3 = Role::create('Role3');

        $role1->assignId(1);
        $role2->assignId(100);
        $role3->assignId(999);

        $this->assertEquals(1, $role1->getId());
        $this->assertEquals(100, $role2->getId());
        $this->assertEquals(999, $role3->getId());
    }

    public function testCreateRoleWithSpecialCharactersInName(): void
    {
        $name = 'Admin-Manager (Level 1)';
        $role = Role::create($name);

        $this->assertEquals($name, $role->getName());
    }
}

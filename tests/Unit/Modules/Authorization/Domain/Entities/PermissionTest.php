<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\Authorization\Domain\Entities;

use App\Modules\Authorization\Domain\Entities\Permission;
use App\Modules\Authorization\Domain\Exception\EmptyRoleNameException;
use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{
    public function testCreateValidPermission(): void
    {
        $id = 'perm-read-user';
        $name = 'Read User';

        $permission = Permission::create($id, $name);

        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals($id, $permission->getId());
        $this->assertEquals($name, $permission->getName());
    }

    public function testCreatePermissionWithValidIdAndName(): void
    {
        $id = 'perm-create-role';
        $name = 'Create Role';

        $permission = Permission::create($id, $name);

        $this->assertEquals('perm-create-role', $permission->getId());
        $this->assertEquals('Create Role', $permission->getName());
    }

    public function testCreatePermissionWithEmptyNameThrowsException(): void
    {
        $this->expectException(EmptyRoleNameException::class);
        $this->expectExceptionMessage('Không được bỏ trống role name!');

        Permission::create('perm-id', '');
    }

    public function testCreatePermissionReturnsPermissionInstance(): void
    {
        $permission = Permission::create('perm-write-system', 'Write System');

        $this->assertInstanceOf(Permission::class, $permission);
    }

    public function testGetIdReturnsCorrectId(): void
    {
        $id = 'perm-delete-user';
        $permission = Permission::create($id, 'Delete User');

        $this->assertEquals($id, $permission->getId());
    }

    public function testGetNameReturnsCorrectName(): void
    {
        $name = 'Update Configuration';
        $permission = Permission::create('perm-update-config', $name);

        $this->assertEquals($name, $permission->getName());
    }

    public function testCreateMultiplePermissionsWithDifferentIds(): void
    {
        $permission1 = Permission::create('perm-1', 'Permission One');
        $permission2 = Permission::create('perm-2', 'Permission Two');

        $this->assertNotEquals($permission1->getId(), $permission2->getId());
        $this->assertNotEquals($permission1->getName(), $permission2->getName());
    }

    public function testCreatePermissionWithSpecialCharactersInName(): void
    {
        $name = 'Permission: Read/Write & Execute (Test)';
        $permission = Permission::create('perm-special', $name);

        $this->assertEquals($name, $permission->getName());
    }

    public function testCreatePermissionWithLongName(): void
    {
        $name = 'This is a very long permission name that contains detailed information about the permission being granted';
        $permission = Permission::create('perm-long', $name);

        $this->assertEquals($name, $permission->getName());
    }
}

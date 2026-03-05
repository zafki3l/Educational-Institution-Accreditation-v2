<?php

namespace Tests\Unit\Modules\DepartmentManagement\Domain\Entities;

use App\Modules\DepartmentManagement\Domain\Entities\Department;
use App\Modules\DepartmentManagement\Domain\Exception\EmptyDepartmentIdException;
use App\Modules\DepartmentManagement\Domain\Exception\EmptyDepartmentNameException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DepartmentTest extends TestCase
{
    /**
     * Run: composer test -- --filter DepartmentTest::it_can_be_created_with_valid_data
     */
    #[Test]
    public function it_can_be_created_with_valid_data(): void
    {
        $id = 'DEPT-001';
        $name = 'Phòng Kỹ Thuật';

        $department = Department::create($id, $name);

        $this->assertInstanceOf(Department::class, $department);
        $this->assertEquals($id, $department->getId());
        $this->assertEquals($name, $department->getName());
    }

    /**
     * Run: composer test -- --filter DepartmentTest::it_throws_exception_when_id_is_empty
     */
    #[Test]
    public function it_throws_exception_when_id_is_empty(): void
    {
        $this->expectException(EmptyDepartmentIdException::class);

        Department::create('', 'Phòng Kỹ Thuật');
    }

    /**
     * Run: composer test -- --filter DepartmentTest::it_throws_exception_when_name_is_empty
     */
    #[Test]
    public function it_throws_exception_when_name_is_empty(): void
    {
        $this->expectException(EmptyDepartmentNameException::class);

        Department::create('DEPT-001', '');
    }
}
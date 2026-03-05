<?php

namespace Tests\Unit\Modules\DepartmentManagement\Application\UseCases;

use App\Modules\DepartmentManagement\Application\UseCases\DeleteDepartmentUseCase;
use App\Modules\DepartmentManagement\Domain\Entities\Department;
use App\Modules\DepartmentManagement\Domain\Repositories\DepartmentRepositoryInterface;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

class DeleteDepartmentUseCaseTest extends TestCase
{
    use DebugHelper;

    private DepartmentRepositoryInterface&MockObject $repository;
    private LoggerInterface&MockObject $logger;
    private DeleteDepartmentUseCase $useCase;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(DepartmentRepositoryInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->useCase = new DeleteDepartmentUseCase($this->repository, $this->logger);
    }

    /**
     * Run: composer test -- --filter DeleteDepartmentUseCaseTest::it_deletes_department_successfully
     */
    #[Test]
    public function it_deletes_department_successfully(): void
    {
        $deptId = 'DEPT-999';
        $actorId = 'admin-001';

        $department = $this->createMock(Department::class);
        $department->method('getId')->willReturn($deptId);

        $this->repository->expects($this->once())
            ->method('findOrFail')
            ->with($deptId)
            ->willReturn($department);

        $this->repository->expects($this->once())
            ->method('delete')
            ->with($department);

        $this->logger->expects($this->once())
            ->method('write')
            ->willReturnCallback(function ($level, $action, $msg, $actor, $context) use ($deptId) {
                $this->debug('CHECK DELETE LOG', [
                    'message' => $msg,
                    'context_id' => $context['id']
                ]);
            });

        $this->useCase->execute($deptId, $actorId);
    }

    /**
     * Run: composer test -- --filter DeleteDepartmentUseCaseTest::it_fails_when_department_not_found
     */
    #[Test]
    public function it_fails_when_department_not_found(): void
    {
        $invalidId = 'NON-EXIST';
        
        $this->repository->method('findOrFail')
            ->willThrowException(new \Exception("Department not found"));

        $this->expectException(\Exception::class);

        $this->repository->expects($this->never())->method('delete');
        $this->logger->expects($this->never())->method('write');

        $this->useCase->execute($invalidId, 'admin-001');
    }
}
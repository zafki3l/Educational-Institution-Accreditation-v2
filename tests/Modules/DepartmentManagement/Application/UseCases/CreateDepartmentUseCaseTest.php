<?php

namespace Tests\Unit\Modules\DepartmentManagement\Application\UseCases;

use App\Modules\DepartmentManagement\Application\Requests\CreateDepartmentRequestInterface;
use App\Modules\DepartmentManagement\Application\UseCases\CreateDepartmentUseCase;
use App\Modules\DepartmentManagement\Domain\Entities\Department;
use App\Modules\DepartmentManagement\Domain\Exception\EmptyDepartmentIdException;
use App\Modules\DepartmentManagement\Domain\Repositories\DepartmentRepositoryInterface;
use App\Shared\Logging\LoggerInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

class CreateDepartmentUseCaseTest extends TestCase
{
    use DebugHelper;

    private DepartmentRepositoryInterface&MockObject $repository;
    private LoggerInterface&MockObject $logger;
    private CreateDepartmentUseCase $useCase;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(DepartmentRepositoryInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->useCase = new CreateDepartmentUseCase($this->repository, $this->logger);
    }

    /**
     * Run: composer test -- --filter CreateDepartmentUseCaseTest::it_creates_department_successfully
     */
    #[Test]
    public function it_creates_department_successfully(): void
    {
        $actorId = 'admin-uuid';
        
        $request = $this->createMock(CreateDepartmentRequestInterface::class);
        $request->method('getId')->willReturn('DEPT-001');
        $request->method('getName')->willReturn('Phòng Kế Toán');

        $this->debug('STEP 1: REQUEST INPUT', [
            'id' => $request->getId(),
            'name' => $request->getName()
        ]);

        $this->repository->expects($this->once())
            ->method('create')
            ->with($this->callback(function (Department $dept) {
                $this->debug('STEP 2: ENTITY CREATED', [
                    'id' => $dept->getId(),
                    'name' => $dept->getName()
                ]);
                return $dept->getId() === 'DEPT-001' && $dept->getName() === 'Phòng Kế Toán';
            }));

        $this->logger->expects($this->once())
            ->method('write')
            ->willReturnCallback(function ($level, $action, $msg, $id, $context) {
                $this->debug('STEP 3: LOG DATA', [
                    'message' => $msg,
                    'context' => $context
                ]);
            });

        $this->useCase->execute($request, $actorId);
    }

    /**
     * Run: composer test -- --filter CreateDepartmentUseCaseTest::it_throws_exception_if_department_data_invalid
     */
    #[Test]
    public function it_throws_exception_if_department_data_invalid(): void
    {
        $request = $this->createMock(CreateDepartmentRequestInterface::class);
        $request->method('getId')->willReturn(''); 

        $this->debug('TEST CASE: Expecting EmptyDepartmentIdException', []);

        $this->repository->expects($this->never())->method('create');
        $this->logger->expects($this->never())->method('write');

        $this->expectException(EmptyDepartmentIdException::class);

        $this->useCase->execute($request, 'admin-uuid');
    }
}
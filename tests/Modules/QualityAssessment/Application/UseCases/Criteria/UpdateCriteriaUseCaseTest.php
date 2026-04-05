<?php

namespace Tests\Unit\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Application\Requests\Criteria\UpdateCriteriaRequestInterface;
use App\Modules\QualityAssessment\Application\UseCases\Criteria\UpdateCriteriaUseCase;
use App\Modules\QualityAssessment\Domain\Entities\Criteria;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

final class UpdateCriteriaUseCaseTest extends TestCase
{
    use DebugHelper;

    private CriteriaRepositoryInterface&MockObject $repository;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private UpdateCriteriaUseCase $useCase;

    private const VALID_ACTOR_ID = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';

    protected function setUp(): void
    {
        $this->repository = $this->createMock(CriteriaRepositoryInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')->willReturnCallback(fn($callback) => $callback());

        $this->useCase = new UpdateCriteriaUseCase(
            $this->repository,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testUpdateCriteriaSuccessfully(): void
    {
        $id = '1.1';
        $actorId = self::VALID_ACTOR_ID;
        $newName = 'Updated Criteria Name';

        $request = $this->createMock(UpdateCriteriaRequestInterface::class);
        $request->method('getId')->willReturn($id);
        $request->method('getName')->willReturn($newName);

        $criteria = $this->createMock(Criteria::class);
        $criteria->method('getId')->willReturn($id);
        $criteria->method('hasChanges')->willReturn(true);
        $criteria->method('getChanges')->willReturn(['name' => ['old' => 'Old', 'new' => $newName]]);

        $this->repository->expects($this->once())
            ->method('findOrFail')
            ->with($id)
            ->willReturn($criteria);

        $criteria->expects($this->once())
            ->method('update')
            ->with($newName);

        $this->repository->expects($this->once())
            ->method('update')
            ->with($criteria);

        $this->eventDispatcher->expects($this->once())->method('dispatch');

        $this->useCase->execute($request, $actorId);

        $this->debug('UPDATE CRITERIA SUCCESS', ['id' => $id]);
    }

    public function testUpdateDoesNothingWhenNoChangesDetected(): void
    {
        $id = '1.1';
        $request = $this->createMock(UpdateCriteriaRequestInterface::class);
        $request->method('getId')->willReturn($id);
        $request->method('getName')->willReturn('Same Name');

        $criteria = $this->createMock(Criteria::class);
        $criteria->method('hasChanges')->willReturn(false);

        $this->repository->method('findOrFail')->willReturn($criteria);

        $criteria->expects($this->once())->method('update');
        $this->unitOfWork->expects($this->never())->method('execute');
        $this->repository->expects($this->never())->method('update');
        $this->eventDispatcher->expects($this->never())->method('dispatch');

        $this->useCase->execute($request, self::VALID_ACTOR_ID);
        
        $this->debug('UPDATE SKIPPED', ['reason' => 'No changes detected']);
    }

    public function testUpdateThrowsExceptionWhenCriteriaNotFound(): void
    {
        $request = $this->createMock(UpdateCriteriaRequestInterface::class);
        $request->method('getId')->willReturn('invalid-id');

        $this->repository->method('findOrFail')
            ->willThrowException(new \Exception("Criteria not found"));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Criteria not found");

        $this->repository->expects($this->never())->method('update');
        $this->eventDispatcher->expects($this->never())->method('dispatch');

        $this->useCase->execute($request, self::VALID_ACTOR_ID);
    }
}
<?php

namespace Tests\Unit\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Application\Requests\Criteria\CreateCriteriaRequestInterface;
use App\Modules\QualityAssessment\Application\UseCases\Criteria\CreateCriteriaUseCase;
use App\Modules\QualityAssessment\Domain\Entities\Criteria;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaIdExistsException;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Modules\QualityAssessment\Domain\Services\CriteriaIdExistsCheckerInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

final class CreateCriteriaUseCaseTest extends TestCase
{
    use DebugHelper;

    private CriteriaRepositoryInterface&MockObject $repository;
    private CriteriaIdExistsCheckerInterface&MockObject $idChecker;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private CreateCriteriaUseCase $useCase;

    private const VALID_ACTOR_ID = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';

    protected function setUp(): void
    {
        $this->repository = $this->createMock(CriteriaRepositoryInterface::class);
        $this->idChecker = $this->createMock(CriteriaIdExistsCheckerInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')->willReturnCallback(fn($callback) => $callback());

        $this->useCase = new CreateCriteriaUseCase(
            $this->repository,
            $this->idChecker,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testExecuteSuccessfully(): void
    {
        $actorId = self::VALID_ACTOR_ID;
        $request = $this->createMock(CreateCriteriaRequestInterface::class);
        $request->method('getId')->willReturn('1.1');
        $request->method('getStandardId')->willReturn('1');
        $request->method('getName')->willReturn('Quality Criteria');

        $this->idChecker->method('check')->with('1.1')->willReturn(false);

        $this->repository->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Criteria::class));

        $this->eventDispatcher->expects($this->once())->method('dispatch');

        $this->useCase->execute($request, $actorId);
        
        $this->debug('CREATE CRITERIA SUCCESS', ['id' => '1.1']);
    }

    public function testExecuteThrowsExceptionWhenIdAlreadyExists(): void
    {
        $id = '1.1';
        $request = $this->createMock(CreateCriteriaRequestInterface::class);
        $request->method('getId')->willReturn($id);

        $this->idChecker->method('check')->with($id)->willReturn(true);

        $this->expectException(CriteriaIdExistsException::class);

        $this->repository->expects($this->never())->method('create');
        $this->eventDispatcher->expects($this->never())->method('dispatch');

        $this->useCase->execute($request, self::VALID_ACTOR_ID);
    }
}
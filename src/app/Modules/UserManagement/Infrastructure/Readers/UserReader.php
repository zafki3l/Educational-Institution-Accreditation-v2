<?php

namespace App\Modules\UserManagement\Infrastructure\Readers;

use App\Modules\UserManagement\Application\DTOs\EditUserViewDTO;
use App\Modules\UserManagement\Infrastructure\Mappers\EditUserViewDTOMapper;
use App\Modules\UserManagement\Infrastructure\Mappers\IndexUserViewDTOMapper;
use App\Modules\UserManagement\Infrastructure\Models\User;
use App\Shared\Application\Contracts\UserReader\UserReaderInterface;
use App\Shared\Application\DTOs\Paginator\PaginatedResultDTO;
use App\Shared\Domain\UserRole;

class UserReader implements UserReaderInterface
{
    public function all(?string $keyword, ?int $role_id): PaginatedResultDTO
    {
        $query = User::query()
            ->with('role:id,name', 'department:id,name')
            ->orderByDesc('created_at');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%$keyword%")
                    ->orWhere('last_name', 'like', "%$keyword%");
            });
        }

        if (!empty($role_id)) {
            $query->where('role_id', $role_id);
        }

        $paginator = $query->paginate(20, [
            'id',
            'first_name',
            'last_name',
            'email',
            'role_id',
            'department_id'
        ]);

        $items = $paginator->getCollection()
            ->map(fn($user) => IndexUserViewDTOMapper::fromModel($user))
            ->toArray();

        return new PaginatedResultDTO(
            $items,
            $paginator->currentPage(),
            $paginator->perPage(),
            $paginator->total(),
            $paginator->lastPage()
        );
    }

    public function allStaffs(?string $keyword, int $role_id = UserRole::ROLE_STAFF): PaginatedResultDTO
    {
        return $this->all($keyword, $role_id);
    }

    public function findById(string $id): EditUserViewDTO
    {
        $user = User::query()
            ->select(
                'id',
                'first_name',
                'last_name',
                'email',
                'role_id',
                'department_id'
            )
            ->where('id', $id)
            ->first();

        return EditUserViewDTOMapper::fromModel($user);
    }

    public function count(): int
    {
        return User::count();
    }

    public function countByRoleId(int $role_id): int
    {
        return User::where('role_id', $role_id)->count();
    }
}

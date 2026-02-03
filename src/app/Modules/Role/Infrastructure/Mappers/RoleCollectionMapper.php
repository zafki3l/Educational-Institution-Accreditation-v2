<?php

namespace App\Modules\Role\Infrastructure\Mappers;

use App\Modules\Role\Domain\Entities\RoleCollection;
use Illuminate\Database\Eloquent\Collection;

class RoleCollectionMapper
{
    public static function toDomain(Collection $eloquentCollection): RoleCollection
    {
        $roles = [];        

        foreach ($eloquentCollection as $model) {
            $domain = RoleMapper::toDomain($model);
            $roles[] = $domain; 
        }

        return new RoleCollection($roles);
    }
}
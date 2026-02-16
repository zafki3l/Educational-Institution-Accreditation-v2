<?php 

namespace App\Modules\UserManagement\Infrastructure\Models;

use App\Modules\Authorization\Infrastructure\Models\Role;
use App\Modules\DepartmentManagement\Infrastructure\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'auth_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'department_id'
    ];
    protected $hidden = ['auth_id', 'password'];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
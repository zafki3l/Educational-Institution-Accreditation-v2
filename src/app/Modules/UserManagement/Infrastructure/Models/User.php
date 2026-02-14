<?php 

namespace App\Modules\UserManagement\Infrastructure\Models;

use App\Modules\Authorization\Infrastructure\Models\Role;
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
        'role_id' 
    ];
    protected $hidden = ['auth_id', 'password'];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
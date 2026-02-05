<?php 

namespace App\Modules\UserManagement\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

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
}
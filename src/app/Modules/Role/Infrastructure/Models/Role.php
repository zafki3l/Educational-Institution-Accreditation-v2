<?php

namespace App\Modules\Role\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['id', 'name'];   
    public $timestamps = false;
}
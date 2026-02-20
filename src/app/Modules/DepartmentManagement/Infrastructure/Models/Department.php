<?php

namespace App\Modules\DepartmentManagement\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name'];   
    public $timestamps = false;
}
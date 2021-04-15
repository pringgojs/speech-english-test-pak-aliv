<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';   
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo('Bican\Roles\Models\Role', 'role_id');
    }
}

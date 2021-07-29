<?php

namespace App;

use App\Models\Student;
use Illuminate\Notifications\Notifiable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roleUser()
    {
        return $this->hasOne('App\Models\RoleUser', 'user_id');
    }

    public function scopeJoinRole($q)
    {
        $q->join('role_user', 'role_user.user_id', '=', 'users.id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }
}

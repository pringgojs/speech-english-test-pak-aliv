<?php

namespace App\Models;

use App\Models\PermissionUser;
use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $table = 'permission_user';

    /**
     * @param $user_id
     * @param $permission_id
     * @return bool
     */
    public static function check($user_id, $permission_id)
    {
        return PermissionUser::where('user_id', '=', $user_id)->where('permission_id', '=', $permission_id)->count() > 0;
    }

    public function scopeJoinPermission($q)
    {
        $q->join('permissions', 'permissions.id', '=', $this->table.'.permission_id');
    }
}

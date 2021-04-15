<?php

namespace App\Helpers;

use App\Models\PermissionUser;
use App\Exceptions\AppException;
use Bican\Roles\Models\Permission;

class AccessHelper
{

    /**
     * @param $permission_slug
     *
     */
    public static function isAllowed($permission_slug)
    {
        $permission = PermissionUser::joinPermission()->where('permissions.slug', $permission_slug)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (! $permission) {
            throw new AppException('RESTRICTED PERMISSION ACCESS', 301);
        }

        return true;
    }

    public static function isAllowedToView($permission_slug)
    {
        $permission = PermissionUser::joinPermission()->where('permissions.slug', $permission_slug)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (! $permission) {
            return false;
        }

        return true;
    }
}

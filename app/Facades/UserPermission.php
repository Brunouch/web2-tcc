<?php

namespace App\Facades;

use App\Models\Permission;

class UserPermission
{

    public static function loadPermissions($user_type)
    {   
        
        $sess = array();
        $perm = Permission::with(['resource'])->where('role_id', $user_type)->get();

        foreach ($perm as $item) {

            $sess[$item->resource->nome] = (bool) $item->permissao;
        }


        session(['user_permissions' => $sess]);

    }

    public static function isAuthorized($rule)
    {

        $permissions = session('user_permissions');

        return $permissions[$rule];
    }

}
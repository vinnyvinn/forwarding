<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 3/11/18
 * Time: 2:05 PM
 */

namespace App\Http\Controllers;


use App\User;

class EslPolicy
{
    public static function auth()
    {
        return new self;
    }

    public function checkPermission(User $user, array $permission)
    {
        return $user->hasAccess($permission);
    }
}
<?php

namespace app\helpers;

use Yii;

class AuthHelper
{
    public static function assignRole(string $role,int $userId)
    {
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole($role), $userId);
    }

}
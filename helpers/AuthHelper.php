<?php

namespace app\helpers;

use Yii;

class AuthHelper
{
    public static function assignUserRole(int $userId)
    {
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole('user'), $userId);
    }
}
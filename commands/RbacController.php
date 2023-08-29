<?php

namespace app\commands;

use app\helpers\AuthHelper;
use app\models\Users;
use yii\base\InvalidParamException;
use yii\console\Controller;

class RbacController extends Controller
{
    private const ROLE_USER='user';
    private const ROLE_ADMIN='admin';
    private const PERMISSION_EXPENSE_CREATE='createExpense';
    private const PERMISSION_EARNINGS_CREATE='createEarning';
    private const PERMISSION_EXPENSE_CREATE_DESCRIPTION='Create Expense Record';
    private const PERMISSION_EARNINGS_CREATE_DESCRIPTION='Create Earnings Record';
    private const PERMISSION_SOURCE_CREATE='createSource';
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        // add "createPost" permission
        $createExpense = $auth->createPermission(self::PERMISSION_EXPENSE_CREATE);
        $createExpense->description = self::PERMISSION_EXPENSE_CREATE_DESCRIPTION;
        $auth->add($createExpense);

        // add "updatePost" permission
        $createEarnings = $auth->createPermission(self::PERMISSION_EARNINGS_CREATE);
        $createEarnings->description = self::PERMISSION_EARNINGS_CREATE_DESCRIPTION;
        $auth->add($createEarnings);

        // add "author" role and give this role the "createPost" permission
        $user = $auth->createRole(self::ROLE_USER);
        $auth->add($user);
        $auth->addChild($user, $createExpense);
        $auth->addChild($user,$createEarnings);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        /*$admin = $auth->createRole(self::ROLE_ADMIN);
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);*/

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        //$auth->assign($admin, 1);
    }


}
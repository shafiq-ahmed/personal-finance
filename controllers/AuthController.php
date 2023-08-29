<?php

namespace app\controllers;

use app\helpers\AuthHelper;
use app\models\Users;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionSignup()
    {
        $user= new Users();

        try {
            if ($this->request->isPost && $user->load($this->request->post())) {
                $user->save();
                AuthHelper::assignUserRole($user->id);
                $this->redirect(['expense/index']);
            }
        }catch (\Throwable $userSaveError)
        {
            \Yii::$app->session->setFlash($userSaveError->getMessage());
        }

        return $this->render('signup',[
            'model'=>$user
        ]);
    }

}
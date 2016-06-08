<?php

namespace app\commands;


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAllPermissions();
        $auth->removeAllRoles();
        $auth->removeAllRules();                
        
        $user = $auth->createRole('user');        
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);                
        
        $auth->assign($admin, 1);
    }
}
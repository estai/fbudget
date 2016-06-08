<?php

namespace app\modules\admin;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface {

    /**
     * @inheritdoc
     */
    public function bootstrap($app) {
        if ($app instanceof \yii\web\Application) {
            $app->getUrlManager()->addRules([
                [
                    'pattern' => '/admin',
                    'route' => 'admin/default/index',
                ],
                    ], false);
        }

        Yii::setAlias('@admin', __DIR__);
    }

}

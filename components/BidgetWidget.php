<?php
namespace app\components;

use app\models\Transaction;
use yii\base\Widget;
use Yii;

class BidgetWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = Transaction::find()->orderBy(['date' => SORT_DESC])->one();
        if ($model) {
            return $model->balance;
        } else {
            return \app\models\Budget::find()->one()->summ;
        }
    }

}
<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\CatTransaction;
use app\models\User;

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="site-index">
    <h3><?= $this->title ?></h3>
    <div class="col-xs-4">

        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'post',
        ]);
        ?>
       <?php
        echo DatePicker::widget(
            [
                'name' => 'date',
                'id' => 'dateSort',
                'dateFormat' => 'php:m/d/Y',
                'options' => [
                    'class' => 'form-control'
                ],

                'clientOptions' => [

                    'changeMonth' => true,
                    'changeYear' => true,
                    'onClose' => new \yii\web\JsExpression('function(dateText, inst) { 
                             
            $(this).datepicker("setDate", new Date(inst.selectedYear, inst.selectedMonth, 1));
              $("#w0").submit(); 
        }
'),

                    'dateFormat' => 'php:m/d/Y',

                    'maxDate' => 'new Date()',
                ],
            ]
        )
        ?>


    </div>
    <?= Html::a('Полная статистика', ['full-stat'], ['class' => 'btn btn-primary']) ?>
    <br>

    <?php ActiveForm::end(); ?>

    <?php
    echo
    ChartJs::widget([
        'type' => 'Line',
        'options' => [
            'height' => 400,
            'width' => 800
        ],
        'data' => [
            'labels' => $days,
            'datasets' => [
                [
                    'fillColor' => "rgba(220,220,220,0.5)",
                    'strokeColor' => "rgba(220,220,220,1)",
                    'pointColor' => "rgba(220,220,220,1)",
                    'pointStrokeColor' => "#fff",
                    'data' => $balance
                ]
            ]
        ]
    ]);
    ?>
    <h3>Все транзакции</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'user_id',
                'format'=>'raw',
                'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(User::find()->where(['!=', 'id', '1'])->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '']
                ),
                'value' => function ($model) {
                    $item = User::find()->where(['id' => $model->user_id])->one();
                    return  Html::a($item->name, ['/stat/user', 'id' => $item->id]);
                },
            ],
            [
                'attribute' => 'cat_id',
                'filter' => Html::activeDropDownList($searchModel, 'cat_id', ArrayHelper::map(CatTransaction::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '']
                ),
                'value' => function ($model) {
                    $item = CatTransaction::find()->where(['id' => $model->cat_id])->one();
                    return $item->name;
                },
            ],
            'summ',
        ],

    ]); ?>
    
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TypeTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тип транзакции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать тип транзакции', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
             [
                'attribute' => 'type',
                'filter' => array(0 => 'Затраты',1 => 'Прибыль'),
                'format' => 'raw',
                'value' => function($model) {
                            if ($model->type == 0){
                                return '-';
                            }    
                            if ($model->type == 1){
                                return '+';
                            }                            
                        }
            ],

            ['class' => 'yii\grid\ActionColumn','template' => '{delete}'],
        ],
         
    ]); ?>
</div>

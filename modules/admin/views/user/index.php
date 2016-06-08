<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'name',
//            'password_hash',
//            'auth_key',
             'email:email',
                                 [
                        'attribute' => 'created_at',
                        'format' => 'date',
                        'filter' => DatePicker::widget(
                                [
                                    'model' => $searchModel,
                                    'attribute' => 'created_at',
                                    'options' => [
                                        'class' => 'form-control'
                                    ],
                                    'clientOptions' => [
                                        'dateFormat' => 'dd.mm.yy',
                                        'maxDate' => 'new Date()',
                                    ],
                                ]
                        )
                    ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

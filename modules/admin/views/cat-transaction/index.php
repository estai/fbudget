<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TypeTransaction;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категория';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'type_id',
                'filter' => Html::activeDropDownList($searchModel, 'type_id',
                    ArrayHelper::map(TypeTransaction::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'), ['class'=>'form-control','prompt' => '']
                ),
                'value' => function ($model) {
                    $item = TypeTransaction::find()->where(['id' => $model->type_id])->one();
                    return $item->name;
                },
            ],
            'name',

              ['class' => 'yii\grid\ActionColumn','template' => '{delete}'],
        ],
    ]); ?>
</div>

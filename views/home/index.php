<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\CatTransaction;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="site-index">
        <?= Yii::$app->session->getFlash('error'); ?>
        <hr>
        <h3>Транзакции</h3>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
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
        ]);
        ?>
   

<p>
    <?= Html::a('Добавить транзакцию', '#', ['class' => 'btn btn-primary', 'data-target' => "#licenseModal", 'data-toggle' => "modal"]) ?>
      <?= Html::a('Статистика', '/stat', ['class' => 'btn btn-success']) ?>
</p>
<?php
Modal::begin([
    'header' => '<h2 class="text-center">' . \Yii::t('app', 'Добавить транзакцию') . '</h2>',
    'size' => "modal-md",
    'options' => [
        'id' => 'licenseModal',
    ],
]);
?>

<?php $form = ActiveForm::begin(['id' => "form-call", 'action' => '/home/create']); ?>


<?=
$form->field($model, 'cat_id')->dropDownList(
        ArrayHelper::map(app\models\CatTransaction::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '']
);
?>
<?php #$form->field($model, 'user_id', ['options' => ['value'=> Yii::$app->user->getId()] ])->hiddenInput()->label(false); ?>
<?= $form->field($model, 'summ')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>



<?php Modal::end(); ?>
 </div>

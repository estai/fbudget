<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CatTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cat-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

 
      <?= $form->field($model, 'type_id')->dropDownList(
                ArrayHelper::map(app\models\TypeTransaction::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '']
            );?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

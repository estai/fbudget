<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TypeTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      <?=
    $form->field($model, 'type')->dropDownList(
            array('1' => '+', '0' => '-'), ['options' => [
            $model->type => ['selected ' => true],
        ]
            ]
    )->label('Тип');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

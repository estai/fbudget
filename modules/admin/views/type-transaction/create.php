<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeTransaction */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Тип транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

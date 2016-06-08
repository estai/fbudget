<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CatTransaction */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категория транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

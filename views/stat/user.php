<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">
    <h3><?= $this->title?></h3>

    <table class="table">
        <tr>
            <th style="width: 15%">Операция</th>
            <th>Сумма</th>
             <th>Время</th>
             <th>Остаток</tr>
            
        </tr>
        <?php
        foreach ($model->transactions as $transaction) {
          
            echo Html::beginTag('tr');
            echo Html::beginTag('td');
            echo $transaction->cat->name;
            echo Html::endTag('td');
            echo Html::beginTag('td');
            echo $transaction->summ;
            echo Html::endTag('td');
            echo Html::beginTag('td');
            echo date('d.m.Y',$transaction->date);
            echo Html::endTag('td');
            echo Html::beginTag('td');
            echo $transaction->balance;
            echo Html::endTag('td');
            echo Html::endTag('tr');
        }
        ?>
    </table>
</div>

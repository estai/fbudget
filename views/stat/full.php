<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Полная статистика по годам';
$this->params['breadcrumbs'][] = ['label' => 'Статистика', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">
    <h3><?= $this->title ?></h3>
    <div class="col-xs-4">

        <?php
        echo
        ChartJs::widget([
            'type' => 'Line',
            'options' => [
                'height' => 400,
                'width' => 800
            ],
            'data' => [
                'labels' => $years,
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
    </div>
</div>
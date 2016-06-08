<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(
    '
           
   
          $(document).on("ready pjax:success", function () {
    $(document).ready(function () {        
   
    $(document).on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});
   


    });
});', $this::POS_READY
);

?>
<?php yii\widgets\Pjax::begin(['id' => 'statPjax', 'enablePushState' => false]); ?>
<div class="site-index">
    <h3><?= $this->title ?></h3>
    <div class="col-xs-4">

        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'post',
        ]);
        ?>
        <?php
        echo DatePicker::widget(
                [
                    'name' => 'date',
                    'id' => 'dateSort',
                    'dateFormat' => 'MM.yyyy',
                    'options' => [
                        'class' => 'form-control'
                    ],
                    'clientOptions' => [

                        'changeMonth' => true,
                        'changeYear' => true,
                        'onClose' => new \yii\web\JsExpression('function(dateText, inst) { 
                             
            $(this).datepicker("setDate", new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
       
   

'),
                        'dateFormat' => 'mm.yy',
                        
                        'maxDate' => 'new Date()',
                    ],
                ]
        )
        ?>
    </div>
    <?= Html::a('Полная статистика за года', ['full-stat'], ['class' => 'btn btn-primary']) ?>
    <br>

    <?php ActiveForm::end(); ?>

    <?php
    echo
    ChartJs::widget([
        'type' => 'Line',
        'options' => [
            'height' => 400,
            'width' => 800
        ],
        'data' => [
            'labels' => $days,
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


    <h3>Пользователи</h3>

    <table class="table">
        <tr>
            <th style="width: 15%">Имя пользователя</th>
            <th></th>

        </tr>
        <?php
        foreach ($users as $user) {

            echo Html::beginTag('tr');
            echo Html::beginTag('td');
            echo $user->name;
            echo Html::endTag('td');
            echo Html::beginTag('td');
            echo Html::a('<span class="glyphicon glyphicon-stats"></span>', ['/stat/user', 'id' => $user->id]);
            echo Html::endTag('td');
            echo Html::endTag('tr');
        }
        ?>
    </table>
</div>
<?php yii\widgets\Pjax::end(); ?>
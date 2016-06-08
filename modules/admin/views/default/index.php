<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Menu;

$this->title = 'Административная панель'
?>
<?php
if (Yii::$app->user->isGuest) {
    echo 'guest';
} else {
    
};
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4 text-center">
        <?php
        echo Menu::widget([
            'items' => [
             
                ['label' => 'Управление пользователей', 'url' => ['/admin/user']],
            #    ['label' => 'Редактор транзакции', 'url' => ['/admin/transaction']],
                ['label' => 'Редактор типа транзакции', 'url' => ['/admin/type-transaction']],
                ['label' => 'Редактор категорий транзакции', 'url' => ['/admin/cat-transaction']],
                ['label' => 'Cтатистика', 'url' => '/stat'],
                ['label' => 'Перейти на сайт', 'url' => ['/']],
            ],
            'options' => ['class' => 'nav nav-pills nav-stacked']
        ]);
        ?>

    </div>
</div>
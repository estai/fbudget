<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php                                
                if(Yii::$app->user->can('admin') || Yii::$app->user->can('moder')){
                    NavBar::begin([
                        'brandLabel' => 'Административная панель',
                        'brandUrl' => '/admin/default/index',
                        'options' => [
                            'class' => 'navbar-admin navbar-fixed-top',
                        ],
                    ]);
                    $menuItems[] = [
                        'label' => '',
                        'url' => ['/admin/default/logout'],
                        'linkOptions' => [
                            'data-method' => 'post',
                            'class' => 'glyphicon glyphicon-log-out',
                            'title' => 'Выход'
                        ]
                    ];
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => $menuItems,
                    ]);
                    NavBar::end();
                }            
            ?>
            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'homeLink' => [ 
                      'label' => 'Главная',
                      'url' => '/admin/default/index',
                 ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    
                ])
                ?>
                    
                   
                <?= $content ?>                
            </div>
        </div>

        <footer class="footer">
            <div class="container">                
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Transaction;

class HomeController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
            $this->redirect('/site/login');
        },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $userid = Yii::$app->user->getId();
        $balance = $this->findBalance();

        $searchModel = new \app\models\TransactionSearch();
        $model = new \app\models\Transaction();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $userid);
        return $this->render('index', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new Transaction();
        $model->user_id = Yii::$app->user->getId();


        if ($model->load(Yii::$app->request->post())) {

            if ($this->calculateBalance($model) && $model->save()) {

                return $this->redirect(['index']);
            } else {
                Yii::$app->session
                        ->setFlash('danger', 'Ваш семейный бюджет не понесет столько убытков');

                return $this->redirect(['index']);
            }
        } else {

            return $this->redirect(['index']);
        }
    }

    protected function findBalance() {
        $model = Transaction::find()->orderBy(['date' => SORT_DESC])->one();
        if ($model) {
            return $model->balance;
        } else {
            return \app\models\Budget::find()->one()->summ;
        }
    }
    

    protected function calculateBalance($entity) {
        $entity->date = time();
        $entity->year=date('Y', time());
        $balance = $this->findBalance();
        $model = \app\models\CatTransaction::findOne($entity->cat_id);
        $type = $model->type;
        if ($type->type == 0) {
            $result = $balance - $entity->summ;
            if ($result < 0) {
                return false;
            }
            $entity->balance = $result;
            return true;
        } else {
            $result = $balance + $entity->summ;
            $entity->balance = $result;
            return true;
        }
    }

}

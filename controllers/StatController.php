<?php

namespace app\controllers;

use app\models\TransactionSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Transaction;
use app\models\User;
use yii\web\NotFoundHttpException;

class StatController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user', 'admin'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
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

    public function actionIndex()
    {
        $days = [];
        $balance = [];
        if ($filter = Yii::$app->request->post()) {
            $data = strtotime($filter['date']);
            $time = strtotime(date('M.Y', $data));
            $current = strtotime(date('d.M.Y', $data + 2678400));
            if ($current > time()) {
                $current = strtotime(date('d.M.Y', time()));
            }
        } else {
            $time = strtotime(date('M.Y', time()));
            $current = strtotime(date('d.M.Y', time()));
        }

        for ($i = $time; $i <= $current; $i = $i + 86400) {
            $days[] = date('d.m', $i);
            $balance[] = $this->findBalance(date('d.M.Y', $i));
        }
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'days' => $days,
            'balance' => $balance,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUser($id)
    {
        $model = $this->findUser($id);
        return $this->render('user', [
            'model' => $model
        ]);
    }


    public function actionFullStat()
    {
        $years = [];
        $balance = [];
        for ($i = date('Y', time()); $i <= date('Y'); $i++) {
            $years[] = "{$i}";
            $balance[] = $this->findBalanceYear($i);
        }
        return $this->render('full', [
            'years' => $years,
            'balance' => $balance,
        ]);
    }

    protected function findBalance($date)
    {
        $time = strtotime($date);
        $model = Transaction::find()->where(['between', 'date', $time, $time + 86399])->orderBy(['date' => SORT_DESC])->one();
        if ($model) {
            return $model->balance;
        } else {
			$entity = Transaction::find()->where(['<', 'date', $time])->orderBy(['date' => SORT_DESC])->one();
			return $entity?$entity->balance:\app\models\Budget::find()->one()->summ;
            
        }
    }

    protected function findBalanceYear($i)
    {
        $model = Transaction::find()->where(['year' => $i])->orderBy(['date' => SORT_DESC])->one();
        if ($model) {
            return $model->balance;
        } else {
            return \app\models\Budget::find()->one()->summ;
        }
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

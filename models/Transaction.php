<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $cat_id
 * @property string $summ
 * @property string $balance
 * @property integer $date
 * @property string $year
 *
 * @property User $user
 * @property CatTransaction $cat
 */
class Transaction extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'cat_id', 'summ', 'balance', 'date'], 'integer'],
            [['date', 'year'], 'required'],
            [['year'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatTransaction::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cat_id' => 'Категория транзакции',
            'summ' => 'Сумма',
            'balance' => 'Balance',
            'date' => 'Date',
            'year' => 'Год',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat() {
        return $this->hasOne(CatTransaction::className(), ['id' => 'cat_id']);
    }

}

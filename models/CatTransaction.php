<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_transaction".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 *
 * @property TypeTransaction $type
 * @property Transaction[] $transactions
 */
class CatTransaction extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cat_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeTransaction::className(), 'targetAttribute' => ['type_id' => 'id']],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'type_id' => 'Тип транзакции',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(TypeTransaction::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions() {
        return $this->hasMany(Transaction::className(), ['cat_id' => 'id']);
    }

}

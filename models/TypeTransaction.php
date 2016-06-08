<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_transaction".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CatTransaction[] $catTransactions
 */
class TypeTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['name','type'], 'required'],
             [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'type' =>'Прибыль/Убыток'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatTransactions()
    {
        return $this->hasMany(CatTransaction::className(), ['type_id' => 'id']);
    }
}

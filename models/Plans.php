<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property int $id
 * @property string $amount_from
 * @property string $amount_to
 * @property string $description
 * @property double $rate
 * @property int $days
 */
class Plans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount_from', 'amount_to', 'description', 'rate', 'days'], 'required'],
            [['amount_from', 'amount_to', 'days'], 'integer'],
            [['rate'], 'number'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount_from' => 'Amount From',
            'amount_to' => 'Amount To',
            'description' => 'Description',
            'rate' => 'Rate',
            'days' => 'Days',
        ];
    }
}

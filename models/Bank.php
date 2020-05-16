<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string $bank_name
 * @property string $bank_code
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_name'], 'required'],
            [['bank_name', 'bank_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_name' => 'Bank Name',
            'bank_code' => 'Bank Code',
        ];
    }
}

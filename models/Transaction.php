<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property string $phone
 * @property string $transaction_reference
 * @property string $description
 * @property string $amount
 * @property string $transaction_from
 * @property string $transaction_to
 * @property string $type
 * @property string $status
 * @property string $created_at
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['phone', 'transaction_reference', 'description', 'amount', 'transaction_from', 'transaction_to', 'type', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'transaction_reference' => 'Transaction Reference',
            'description' => 'Description',
            'amount' => 'Amount',
            'transaction_from' => 'Transaction From',
            'transaction_to' => 'Transaction To',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

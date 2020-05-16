<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $merchant_phone
 * @property string $webhook
 * @property string $type
 * @property string $user_phone
 * @property string $status
 * @property string $created_at
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_phone', 'webhook', 'type', 'user_phone', 'status', 'created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_phone' => 'Merchant Phone',
            'webhook' => 'Webhook',
            'type' => 'Type',
            'user_phone' => 'User Phone',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property int $id
 * @property string $phone
 * @property string $auth_token
 * @property string $webhook
 * @property string $status
 * @property string $created_at
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'merchant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['phone', 'auth_token', 'webhook', 'status'], 'string', 'max' => 255],
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
            'auth_token' => 'Auth Token',
            'webhook' => 'Webhook',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

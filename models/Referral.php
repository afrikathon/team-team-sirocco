<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "referral".
 *
 * @property int $id
 * @property int $user_id
 * @property string $referral_name
 * @property int $created_at
 * @property int $updated_at
 */
class Referral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referral';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'referral_name'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['referral_name'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'referral_name' => 'Referral Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

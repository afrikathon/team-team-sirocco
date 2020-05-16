<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property string $id
 * @property string $user_id
 * @property string $type
 * @property string $description
 * @property string $account_reference
 * @property string $amount
 * @property string $payout
 * @property int $days
 * @property string $date_opened
 * @property string $date_due
 * @property string $status
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'description', 'account_reference', 'amount', 'payout', 'days', 'date_opened', 'date_due'], 'required'],
            [['user_id', 'amount', 'payout', 'days'], 'integer'],
            [['date_opened', 'date_due'], 'safe'],
            [['type', 'description', 'account_reference'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1000],
            ['amount','match','not'=>true,'pattern'=>'/[^ 0-9 . \s]/','message'=>'Contains Invalid Characters'],
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
            'type' => 'Type',
            'description' => 'Description',
            'account_reference' => 'Account Reference',
            'amount' => 'Amount',
            'payout' => 'Payout',
            'days' => 'Days',
            'date_opened' => 'Date Opened',
            'date_due' => 'Date Due',
            'status' => 'Status',
        ];
    }

    public function getref($len)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
}

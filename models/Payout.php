<?php

namespace frontend\models;

use Yii;
/**
 * This is the model class for table "payout".
 *
 * @property string $id
 * @property string $user_id
 * @property string $status
 * @property string $confirm_token
 * @property string $recipient_code
 * @property string $amount
 * @property string $request_time
 * @property string $paid_time
 * @property string $reference
 * @property string $account_reference
 * @property int $payout_attempt
 */
class Payout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'reference', 'account_reference'], 'required'],
            [['user_id', 'amount', 'payout_attempt'], 'integer'],
            [['request_time', 'paid_time'], 'safe'],
            [['status', 'recipient_code', 'reference', 'account_reference'], 'string', 'max' => 255],
            [['confirm_token'], 'string', 'max' => 1000],
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
            'status' => 'Status',
            'confirm_token' => 'Confirm Token',
            'recipient_code' => 'Recipient Code',
            'amount' => 'Amount',
            'request_time' => 'Request Time',
            'paid_time' => 'Paid Time',
            'reference' => 'Reference',
            'account_reference' => 'Account Reference',
            'payout_attempt' => 'Payout Attempt',
        ];
    }

    public function getref($len)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

    public static function findByConfirmPaymentToken($token)
    {
        return static::findOne([
            'confirm_token' => $token,
        ]);
    }

    public function sendEmail($payout_id)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'accountConfirmPayout-html', 'text' => 'accountConfirmPayout-text'],
                ['payout_id' => $payout_id]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->user->identity->email)
            ->setSubject('Payout Approval for ' . Yii::$app->name)
            ->send();
    }
}

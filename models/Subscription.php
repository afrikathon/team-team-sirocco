<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property int $id
 * @property string $insurance_code
 * @property string $amount
 * @property string $insurance_type
 * @property string $customer_id
 * @property string $customer_name
 * @property string $company_id
 * @property string $company_name
 * @property string $agent_id
 * @property string $agent_name
 * @property string $status
 * @property string $created_at
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['insurance_code', 'amount', 'insurance_type', 'customer_id', 'customer_name', 'company_id', 'company_name', 'agent_id', 'agent_name', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'insurance_code' => 'Insurance Code',
            'amount' => 'Amount',
            'insurance_type' => 'Insurance Type',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'agent_id' => 'Agent ID',
            'agent_name' => 'Agent Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

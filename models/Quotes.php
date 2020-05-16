<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "quotes".
 *
 * @property int $id
 * @property string $customer_id
 * @property string $customer_name
 * @property string $description
 * @property string $insurance_type
 * @property string $insurance_company
 * @property string $insurance_company_id
 * @property string $feedback
 * @property string $amount
 * @property string $upload
 * @property int $status
 * @property string $created_at
 */
class Quotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['customer_id', 'customer_name', 'description', 'insurance_type', 'insurance_company', 'insurance_company_id', 'feedback', 'amount', 'upload'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'description' => 'Description',
            'insurance_type' => 'Insurance Type',
            'insurance_company' => 'Insurance Company',
            'insurance_company_id' => 'Insurance Company ID',
            'feedback' => 'Feedback',
            'amount' => 'Amount',
            'upload' => 'Upload',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

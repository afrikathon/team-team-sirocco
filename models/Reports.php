<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property int $id
 * @property string $insurance_type
 * @property string $description
 * @property string $submitted_by
 * @property string $report_reference
 * @property string $customer_id
 * @property string $customer_name
 * @property string $company_id
 * @property string $claim_id
 * @property string $status
 * @property string $created_at
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['insurance_type', 'description', 'submitted_by', 'report_reference', 'customer_id', 'customer_name', 'company_id', 'claim_id', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'insurance_type' => 'Insurance Type',
            'description' => 'Description',
            'submitted_by' => 'Submitted By',
            'report_reference' => 'Report Reference',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'company_id' => 'Company ID',
            'claim_id' => 'Claim ID',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

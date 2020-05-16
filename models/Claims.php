<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "claims".
 *
 * @property int $id
 * @property string $description
 * @property string $claim_reference
 * @property string $customer_id
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $company_id
 * @property string $company_name
 * @property string $company_phone
 * @property string $agent_id
 * @property string $agent_name
 * @property string $agent_phone
 * @property string $agent_description
 * @property string $upload
 * @property string $status
 * @property string $created_at
 */
class Claims extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'claims';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 10000],
            [['claim_reference', 'customer_id', 'customer_name', 'customer_phone', 'company_id', 'company_name', 'company_phone', 'agent_id', 'agent_name', 'agent_phone', 'agent_description', 'status'], 'string', 'max' => 255],

            ['upload', 'required'],
            ['upload', 'file', 'maxSize' => 1024 * 1024 * 10, 'message'=>'Image too large, Can not exceed 10 MB'],
            [['upload'], 'file', 'extensions' => 'png, jpg ,jpeg' ,'message'=>'Invalid Image format'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'claim_reference' => 'Claim Reference',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'customer_phone' => 'Customer Phone',
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'company_phone' => 'Company Phone',
            'agent_id' => 'Agent ID',
            'agent_name' => 'Agent Name',
            'agent_phone' => 'Agent Phone',
            'agent_description' => 'Agent Description',
            'upload' => 'Upload',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

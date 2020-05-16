<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property string $amount
 * @property string $type
 * @property string $company_id
 * @property string $company_name
 * @property string $status
 * @property string $created_at
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['code', 'description', 'amount', 'type', 'company_id', 'company_name', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Insurance Name/Code',
            'description' => 'Description',
            'amount' => 'Amount',
            'type' => 'Insurance Category',
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

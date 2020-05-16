<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payment_page".
 *
 * @property int $id
 * @property string $phone
 * @property string $description
 * @property string $image
 * @property string $page_id
 * @property string $owner
 * @property string $status
 * @property string $created_at
 */
class PaymentPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['phone','image', 'page_id', 'owner', 'status'], 'string', 'max' => 5000],
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
            'description' => 'Description of your Business',
            'image' => 'Image',
            'page_id' => 'Page ID',
            'owner' => 'Your Business Name or your name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property string $offer_title
 * @property int $recruiter_id
 * @property string $recruiter_name
 * @property string $recruiter_email
 * @property string $talent_name
 * @property int $talent_id
 * @property string $description
 * @property string $talent_email
 * @property string $talent_response
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Offers extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = "PENDING";
    const STATUS_ACCEPTED = "ACCEPTED";
    const STATUS_DECLINED = "DECLINED";
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['offer_title', 'recruiter_id', 'recruiter_name', 'recruiter_email', 'talent_name', 'talent_id', 'description', 'talent_email'], 'required'],
            [['recruiter_id', 'talent_id', 'created_at', 'updated_at'], 'integer'],
            [['offer_title'], 'string', 'max' => 500],
            [['recruiter_name', 'recruiter_email', 'talent_email', 'status'], 'string', 'max' => 255],
            [['talent_name'], 'string', 'max' => 225],
            [['description'], 'string', 'max' => 10000],
            [['talent_response'], 'string', 'max' => 5000],
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
            'offer_title' => 'Offer Title',
            'recruiter_id' => 'Recruiter ID',
            'recruiter_name' => 'Recruiter Name',
            'recruiter_email' => 'Recruiter Email',
            'talent_name' => 'Talent Name',
            'talent_id' => 'Talent ID',
            'description' => 'Description',
            'talent_email' => 'Talent Email',
            'talent_response' => 'Talent Response',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

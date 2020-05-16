<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "mentor".
 *
 * @property int $id
 * @property int $mentee_id
 * @property string $mentor_name
 * @property string $mentor_email
 * @property int $mentor_id
 * @property string $mentee_name
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Mentor extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = "PENDING";
    const STATUS_ACCEPTED = "ACCEPTED";
    const POINTS_FOR_MENTOR = 50;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mentor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mentee_id', 'mentor_name', 'mentor_email', 'mentor_id', 'mentee_name', 'status'], 'required'],
            [['mentee_id', 'mentor_id', 'created_at', 'updated_at'], 'integer'],
            [['mentor_name', 'mentor_email', 'mentee_name', 'status'], 'string', 'max' => 255],
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
            'mentee_id' => 'Mentee ID',
            'mentor_name' => 'Mentor Name',
            'mentor_email' => 'Mentor Email',
            'mentor_id' => 'Mentor ID',
            'mentee_name' => 'Mentee Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

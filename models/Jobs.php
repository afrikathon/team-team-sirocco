<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property string $job_description
 * @property string $job_type
 * @property string $job_location
 * @property string $job_id
 * @property string $posted_by
 * @property string $assigned_to
 * @property string $status
 * @property string $created_at
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['job_description', 'job_type', 'job_location', 'job_id', 'posted_by', 'assigned_to', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_description' => 'Waste Pickup Request Description',
            'job_type' => 'Waste Pickup Type',
            'job_location' => 'Location',
            'job_id' => 'PickUp Request ID',
            'posted_by' => 'Customer Contact',
            'assigned_to' => 'Company Contact',
            'status' => 'Request Status',
            'created_at' => 'Created At',
        ];
    }
}

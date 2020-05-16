<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $full_name
 * @property string $display_picture
 * @property int $points
 * @property string $job_preference
 * @property string $career_level
 * @property string $years_of_experience
 * @property string $location
 * @property string $skills
 * @property string $cv_url
 * @property string $linkedIn_url
 * @property string $other_links
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Profile extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = "active";
    const POINT_FOR_NEW_REFERRAL=50;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'full_name', 'job_preference', 'career_level', 'location'], 'required'],
            [['user_id', 'created_at', 'updated_at','points'], 'integer'],
            [['full_name', 'display_picture', 'job_preference', 'career_level', 'years_of_experience', 'status'], 'string', 'max' => 255],
            [['location', 'cv_url', 'linkedIn_url'], 'string', 'max' => 500],
            [['skills'], 'string', 'max' => 5000],
            [['other_links'], 'string', 'max' => 1000],
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
            'user_id' => 'User ID',
            'full_name' => 'Full Name',
            'display_picture' => 'Display Picture',
            'points' => 'Points',
            'job_preference' => 'Job Preference',
            'career_level' => 'Career Level',
            'years_of_experience' => 'Years Of Experience',
            'location' => 'Location',
            'skills' => 'Skills',
            'cv_url' => 'CV Url',
            'linkedIn_url' => 'LinkedIn Url',
            'other_links' => 'Other Links',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

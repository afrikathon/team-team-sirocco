<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = (Yii::$app->user->identity->account_type=="talent") ? 'Leader Board' : 'Search Talents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model){
            if($model->user_id == Yii::$app->user->identity->id){
                return['class'=>'success'];
            }else{
                return [];
            }
        },
        'options' => [
            'class' => 'table-responsive',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
            ['class' => 'yii\grid\ActionColumn','template' => '{view}','header'=>'view talent details'],
            'full_name',
            [
                'attribute' => 'job_preference',
                'filter' => ['Frontend Developer' => 'Frontend Developer','Backend Developer' => 'Backend Developer','UX/UI Designer' => 'UX/UI Designer',
                    'Fullstack Developer' => 'Fullstack Developer','DevOps Engineer' => 'DevOps Engineer','Quality Assurance Engineer' => 'Quality Assurance Engineer',
                    'Mobile Application Developer' => 'Mobile Application Developer','Product Manager' => 'Product Manager','Project Manager' => 'Project Manager'],
                'label' => 'Talent Type'
            ],
            [
                'attribute' => 'years_of_experience',
                'filter' => ['1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9'
                    ,'10' => '10','11 - 15' => '11 - 15','16 - 20' => '16 - 20','Above 20' => 'Above 20'
                ],
            ],
            'skills',
//            [
//                'attribute' => 'skills',
//                'contentOptions'=>['style'=>'max-width: 30px;']
//            ],
            [
                'attribute' => 'career_level',
                'filter' => ['Intern' => 'Intern','Entry Level' => 'Entry Level','Junior' => 'Junior','Intermediate' => 'Intermediate','Senior' => 'Senior','Associate'=>'Associate','Manager'=>'Manager'],
            ],
            'points',
            'location',
            //'location',
            //'skills',
            //'cv_url:url',
            //'linkedIn_url:url',
            //'other_links',
            //'status',
            //'created_at',
            //'updated_at',


        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

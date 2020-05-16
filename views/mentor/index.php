<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\Mentor;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MentorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mentor Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentor-index">

    <h1>Your Mentors</h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            //'mentee_id',
            'mentor_name',
            'mentor_email:email',
            'status',
            //'mentee_name',
            //'status',
            'created_at:date:Date',
            //'updated_at',

        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <br/><br/><h1>Your Mentees</h1>
    <?= GridView::widget([
        'dataProvider' => $menteeDataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            //'mentee_id',
            'mentee_name',
            'status',
            //'mentee_name',
            //'status',
            'created_at:date:Date',
            [
              'label'=>'Approve Mentee',
              'format' => 'raw',
              'value'=>function($model){
                    if($model->status == Mentor::STATUS_PENDING){
                        return Html::a('Accept Request', ['approve-mentee', 'id' => $model->id], ['class' => 'btn btn-button-D']);
                    }else{
                        return "";
                    }
              },
            ],
            //'updated_at',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

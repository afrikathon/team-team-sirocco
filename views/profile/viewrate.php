<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->identity->account_type=="talent" && $model->user_id==Yii::$app->user->identity->id){

            echo Html::a('Edit Profile', ['update', 'id' => $model->id], ['class' => 'btn btn-button-D']);
        }else if(Yii::$app->user->identity->account_type=="talent"){
            echo Html::a('Rate This Talent\'s Profile', ['rate-another-talent', 'id' => $model->id], ['class' => 'btn btn-button-D']);
        }?>

        <?php if(Yii::$app->user->identity->account_type=="recruiter"){

            echo Html::a('Make An Offer For This Talent', ['recruiteroffer', 'id' => $model->user_id], ['class' => 'btn btn-button-C']);
        }?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'user_id',
            'full_name',
            //  'display_picture',
           // 'points',
            'job_preference',
            'career_level',
            'years_of_experience',
            'location',
            'skills',
            'cv_url:url',
            'linkedIn_url:url',
            'other_links',
//            'status',
//            'created_at',
//            'updated_at',
        ],
    ]) ?>

</div>

<?php
    Modal::begin([
        'id'=>'modal',
        'size'=>'modal-md',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Offers;

/* @var $this yii\web\View */
/* @var $model frontend\models\Offers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-view">

    <p>
        <?php// Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
        <?php if(Yii::$app->user->identity->account_type=="talent" && $model->status==Offers::STATUS_PENDING){

            echo Html::a('Respond To Offer', ['talentresponse', 'id' => $model->id], ['class' => 'btn btn-button-D']);
        }?>
    </p>

    <?php if(Yii::$app->user->identity->account_type=="talent"){
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'offer_title',
                // 'recruiter_id',
                'recruiter_name',
                'recruiter_email:email',
                'status',
                //'talent_name',
                //'talent_id',
                'description',
                //'talent_email:email',
                'talent_response',
                'created_at:date:Date',
                // 'created_at',
            ],
        ]);
    }else{
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'offer_title',
                // 'recruiter_id',
                //'recruiter_name',
                //'recruiter_email:email',
                'talent_name',
                'talent_email:email',
                'status',
                'talent_response',
                'description',
                'created_at:date:Date',
                // 'created_at',
            ],
        ]);
    }?>

</div>

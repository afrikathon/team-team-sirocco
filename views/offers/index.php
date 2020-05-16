<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OffersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if(Yii::$app->user->identity->account_type=="talent") { ?>

        <?php  echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'table-responsive',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'offer_title',
            //'recruiter_id',
            'recruiter_name',
            'recruiter_email:email',
            // 'talent_name',
            //'talent_id',
            //'description',
            //'talent_email:email',
            //'talent_response',
            'status',
            'created_at:date:Date',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ],
    ]);
    }else{

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => [
                'class' => 'table-responsive',
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'offer_title',
                'talent_name',
                'talent_email:email',
                //'recruiter_email:email',
                //'talent_name',
                //'talent_id',
                //'description',
                //'talent_email:email',
                //'talent_response',
                'status',
                'created_at:date:Date',
                //'created_at',

                ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
            ],
        ]);
    }?>
    <?php Pjax::end(); ?>
</div>

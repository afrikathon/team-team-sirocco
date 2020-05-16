<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReferralSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referral Dashboard';
$this->params['breadcrumbs'][] = $this->title;
$referralUrl = Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'id' =>Yii::$app->user->identity->id]);
?>
<div class="referral-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <h4>This is your referral link <a href="<?=$referralUrl?>"><b><?=$referralUrl?></b></a> <br/><br/>Share your referral link with your tech friends and earn 50 points when they register.</h4>
    <h3>Your Referrals</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'referral_name',
            'created_at:date:Date Registered'
//
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

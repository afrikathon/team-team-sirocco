<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Your Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">
    <p>
        <?= Html::a('Rate Another Talent', ['rate-talent'], ['class' => 'btn btn-button-D']) ?>
    </p>
    <br/><br/>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            //'reviewer_id',
            'rating',
            'description',
            'created_at:date:Date Reviewed',
            //'updated_at',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

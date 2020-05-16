<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\Accountssearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Withdraw';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table wik12'],

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'type',
            'amount',
            'payout',
            'date_due',
            'status',
            [
                'label'=>'Action',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($model){
                    $id=$model->id;
                    $due_date_value=strtotime($model->date_due);
                    $current_time=strtotime(date('Y-m-d h:i:s'));
                    if($due_date_value <= $current_time){
                        $html="<a href='payout?id=$id' class='yellow-link'><span><b>Withdraw</b></span></a>";
                    }else{
                        $html="<a href='payout?id=$id'  class='yellow-link' data-confirm='Please be informed your payout will be your initial investment, You are requesting payout before the Due Date.
                                        Click OK to Proceed'><span><b>Withdraw</b></span></a>";
                    }
                    return $html;
                },
            ],
            

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

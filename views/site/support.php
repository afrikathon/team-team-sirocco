<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\Chatsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Support Chat';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row wik14">
    <div class="col-lg-2" ></div>
    <div class="col-lg-8 center">
            <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'',
            'itemView'=> function ($model,$key,$index,$widget){
            if ($model->sent_from == "support" && $model->user_id==Yii::$app->user->id) {?>
                    <div class="row">
                    <div style="color: black;background-color: #00800042;padding :10px;margin: 5px ;border-radius: 0px 20px 20px 20px;" class="col-lg-6 pull-left rounded-top"><b><?= Html::encode($model->message) ?></b><!--for unread #008000a1  for read#00800042-->  
                    </div>
                    </div>
            <?php
            }elseif($model->user_id==Yii::$app->user->id){?>
                    <div class="row">
                    <div style="color: black;background-color: #eea2362b;padding :10px;margin: 5px;border-radius: 20px 0px 20px 20px; " class="col-lg-6 pull-right" ><b><?= Html::encode($model->message) ?></b> 
                    </div>
                    </div>
            <?php
            }
            ?>
            <?php
            }
            ])?>  
    </div> 
</div>
<div class="col-lg-2"></div>
<div class="chat-form col-lg-8 pull-right">
    <div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-8 support">
        <?= $form->field($model, 'message')->textarea(['rows' => 3]) ?>  
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <br>
            <?= Html::submitButton('Send Message', ['class' => 'btn btn-warning']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    </div>

</div>
    <?php
        Modal::begin([
            'header'=>"<b><h4 id='reshead'></h4></b>",
            'id'=>'modal',
            'size'=>'modal-md',
            ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

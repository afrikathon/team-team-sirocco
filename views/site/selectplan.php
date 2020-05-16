<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use frontend\models\Plans;
/* @var $this yii\web\View */
/* @var $model frontend\models\Accounts */
/* @var $form ActiveForm */
?>
<div class="selectplan" style="padding: 20px">

    <?php $form = ActiveForm::begin(); ?>

        <?php
        $to_send='$.post("company?id='.'"+$(this).val()+"&type='.$plan.'", function(data){
                    $("select#products-code").html(data);
                    });';
        $to_send2='$.post("code?code='.'+$(this).val()", function(data){
                    $("div#estimate").html(data);
                    });';
        $cateoryMess="Select Insurance Package Under ".$plan." Category";
         echo $form->field($model, 'company_name')->dropDownList(
                ArrayHelper::map(User::find()->where ("account_type='company'")->all(),'id','username'),
             [
                 'prompt'=>'Select Insurance Company',
                 'onchange'=>$to_send,
             ]
            );
        ?>
        <?= $form->field($model2, 'code') ->dropDownList([], [
            [],
            'onchange'=>'
                    $.post("code?id='.'"+$(this).val(), function(data){
                    $("div#estimate").html(data);
                    });'
        ])->label($cateoryMess); ?>
        <br><div id="estimate"></div><br><div><b>
        </div><br>
    
        <div class="form-group" align="center">
            <?= Html::submitButton('<b>PROCEED</b>', ['class' => 'btn-block btn btn-warning','style'=>'border-radius: 19px']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- selectplan -->

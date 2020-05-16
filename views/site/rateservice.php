<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Rating */
/* @var $form ActiveForm */
?>
<div class="rateservice">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'job_id')->label("Enter PickUp Request ID you want to rate"); ?>
    <?= $form->field($model, 'rating_value')->dropDownList(
        ['1' => '1','2' => '2','3' => '3','4' => '4','5' => '5'],
        [
            'prompt'=>'Rate the waste company service',

        ]); ?>

    <?= $form->field($model, 'comment')->label("Drop comments about how your request was handled"); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- rateservice -->

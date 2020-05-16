<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PaymentPage */
/* @var $form ActiveForm */
?>
<div class="paymentpage">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'owner') ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- paymentpage -->

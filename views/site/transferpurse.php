<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transaction */
/* @var $form ActiveForm */
?>
<div class="transferpurse">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 2])?>
        <?= $form->field($model, 'amount') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Transfer Fund', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- transferpurse -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transact */
/* @var $form ActiveForm */
?>
<div class="fundwallet">

    <?php $form = ActiveForm::begin(); ?>

        <div><h3>How much do you want to fund your purse with..?</h3></br></br></div>

        <?= $form->field($model, 'amount') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Pay', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- fundwallet -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transact */
/* @var $form ActiveForm */
?>
<div class="fundwallet">

    <?php $form = ActiveForm::begin(); ?>

    	<div align="center">
	        <div><h3>Hi, Welcome to <?= $page->owner ?> payment page...</h3></br></br></div><br>

	        <div> <?= $page->description ?></div><br><br>

	        <?= $form->field($model, 'amount') ?>
	    
	        <div class="form-group">
	            <?= Html::submitButton('Pay', ['class' => 'btn btn-primary']) ?>
	        </div>    		
    	</div>
    <?php ActiveForm::end(); ?>

</div><!-- fundwallet -->
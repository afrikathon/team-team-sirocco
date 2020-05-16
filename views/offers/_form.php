<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Offers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'offer_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recruiter_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recruiter_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recruiter_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'talent_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'talent_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'talent_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'talent_response')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

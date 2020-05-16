<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mentor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mentor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mentee_id')->textInput() ?>

    <?= $form->field($model, 'mentor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mentor_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mentor_id')->textInput() ?>

    <?= $form->field($model, 'mentee_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

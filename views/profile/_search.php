<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'display_picture') ?>

    <?= $form->field($model, 'points') ?>

    <?php // echo $form->field($model, 'job_preference') ?>

    <?php // echo $form->field($model, 'career_level') ?>

    <?php // echo $form->field($model, 'years_of_experience') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <?php // echo $form->field($model, 'cv_url') ?>

    <?php // echo $form->field($model, 'linkedIn_url') ?>

    <?php // echo $form->field($model, 'other_links') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

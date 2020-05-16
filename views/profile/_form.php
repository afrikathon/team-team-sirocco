<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'display_picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_preference')->dropDownList(
        ['Frontend Developer' => 'Frontend Developer','Backend Developer' => 'Backend Developer','UX/UI Designer' => 'UX/UI Designer',
            'Fullstack Developer' => 'Fullstack Developer','DevOps Engineer' => 'DevOps Engineer','Quality Assurance Engineer' => 'Quality Assurance Engineer',
            'Mobile Application Developer' => 'Mobile Application Developer','Product Manager' => 'Product Manager','Project Manager' => 'Project Manager'],
        [
            'prompt'=>'Select Your Job Preference',

        ]) ?>

    <?= $form->field($model, 'career_level')->dropDownList(
        ['Intern' => 'Intern','Entry Level' => 'Entry Level','Junior' => 'Junior','Intermediate' => 'Intermediate','Senior' => 'Senior','Associate'=>'Associate','Manager'=>'Manager'],
        [
            'prompt'=>'Select Your Career Level',

        ])
    ?>

    <?= $form->field($model, 'years_of_experience')->dropDownList(
        ['1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9'
            ,'10' => '10','11 - 15' => '11 - 15','16 - 20' => '16 - 20','Above 20' => 'Above 20'
        ],
        [
            'prompt'=>'Select Your Years Of Experience',

        ])
    ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skills')->textInput(['maxlength' => true])->label("Enter Your Skills Separated by Comma e.g Java,Php,Mysql") ?>

    <?= $form->field($model, 'cv_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkedIn_url')->textInput(['maxlength' => true])->label("LinkedIn Url") ?>

    <?= $form->field($model, 'other_links')->textInput(['maxlength' => true])->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-button-D']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

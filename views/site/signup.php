<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use frontend\models\Bank;

$this->title = 'Create your account';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">


    <div class="signup row ">
    <div class="col-sm-6 wik18" style="background-color: rgb(115, 112, 216)">
    <div class="full-screen-height">
    <div  class="wik3 wik5">

<p class="wik1">Already have an account? </p>
<a  href="login" class="btn login-btn2">Sign in</a>
<a href="/talentocean" class="btn login-btn2">Home</a>

</div>

</div>   
</div>
        <div class="col-sm-6 wik22">
         <div class="container2">
        <h3><?= Html::encode($this->title) ?></h3>

            <?php $form = ActiveForm::begin(['id' => 'form-signup','options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form__input']) ?>

             <?= $form->field($model, 'email')->textInput(['class' => 'form__input'])  ?>

             <?= $form->field($model, 'phone')->textInput(['class' => 'form__input'])  ?>

             <?= $form->field($model, 'password')->passwordInput(['class' => 'form__input']) ?>

                <?= $form->field($model, 'confirmpassword')->passwordInput(['class' => 'form__input']) ?>

             <?= $form->field($model, 'account_type')->dropDownList(
                 ['recruiter' => 'Recruiter', 'talent' => 'Talent (Job Seeker)'],
                 [
                     'prompt'=>'Select Account Type',

                 ]); ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login row wik7">
<div class="col-sm-6 wik4" style="background-color: rgb(115, 112, 216)">
<div  class="wik3 wik5">

<p class="wik1"><span class="wik21">Welcome to Talent Ocean</span><br>
</p>
<a href="signup" class="btn login-btn2">CREATE AN ACCOUNT</a><br><br>
<p class="wik1"> Get The Best Talents
</p>
</div>
</div>
<div class="col-sm-6 wik20">


        <div class="wik6 wik3">
            <?php $form = ActiveForm::begin(['id' => 'login-form'] ); ?>
    <h2 class=""><?= Html::encode($this->title) ?></h2>

            <?= $form->field($model, 'authId')->textInput(['autofocus' => true,'class' => 'form__input','placeholder' => "Email or Username" ])->label(false) ?>

            <?= $form->field($model, 'password')->passwordInput(['class' => 'form__input','placeholder' => "Password"  ])->label(false) ?>

            <div style="color:#999;margin:1em 0">
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login to your Account', ['class' => 'btn btn-login', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
</div>
</div>

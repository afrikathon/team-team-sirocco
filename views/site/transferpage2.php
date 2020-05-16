<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\School;
use frontend\models\Stafflevel;


$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="/cashbreeze/css/style.css">


<div class="pannel">
  <ul class="panel__menu" id="menu">
    <hr/>
    <li id="signIn"> <a href="#"><b>Academic Staff</b></a></li>
    <li id="signUp"><a href="#"><b>Non-Academic Staff</b></a></li>
  </ul>
  <div class="panel__wrap">
    <div class="panel__box active" id="signInBox" style="background-color: gold; padding: 30px;">
 <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'phone')->textInput(['autofocus' => true])->input('text',['placeholder'=>'Username']) ?>

                <?= $form->field($model, 'amount')->input('email',['placeholder'=>'Email'])?>

                <?= $form->field($model, 'description')->passwordInput()->input('password',['placeholder'=>'Password']) ?>

        </div><br>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn-block btn-md btn-primary col-lg-10', 'name' => 'signup-button']) ?>
                </div>

            
            </div>

    </div>
    <?php ActiveForm::end(); ?>
    </div>

    <div class="panel__box" id="signUpBox" style="background-color: #0054ff; padding: 30px;">
    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup2']); ?>
                <?= $form->field($model, 'phone')->textInput(['autofocus' => true])->input('text',['placeholder'=>'Username']) ?>

                <?= $form->field($model, 'amount')->input('email',['placeholder'=>'Email'])?>

                <?= $form->field($model, 'description')->passwordInput()->input('password',['placeholder'=>'Password']) ?>

        </div><br>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn-block btn-md btn-info col-lg-10', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            </div>

    </div>


    </div>
  </div>
</div>
  
    <script src="/cashbreeze/js/index.js"></script>


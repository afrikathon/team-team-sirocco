<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\EditForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use frontend\models\Bank;


$this->title = 'Edit Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wik15">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Edit Account Details:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-editaccount']); ?>

            <?= $form->field($model, 'phone') ?>


            <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'confirmpassword')->passwordInput() ?>

                <?= $form->field($model, 'bank_name')->dropDownList(
                        ArrayHelper::map(Bank::find()->all(),'bank_code','bank_name'),
                [
                        //'prompt'=>'Select Bank',

                ]); ?>

                <?= $form->field($model, 'account_name')->textInput() ?>

                <?= $form->field($model, 'account_number')->textInput() ?>

                <?php //= $form->field($model, 'passport')->fileInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'editaccount-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

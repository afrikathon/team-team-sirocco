<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Offers */

$this->title = 'Rate Talent';
?>
<div class="wik15">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="offers-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'rating')->dropDownList(
            ['1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9'
                ,'10' => '10'],
            [
                'prompt'=>'Select Rating',

            ])->label("Rate This Talent On the Scale Of One to Ten") ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true])->textarea(['rows' => 2])->label("What is the reason for your response?")?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-button-D']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

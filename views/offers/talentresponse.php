<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Offers */

$this->title = 'Respond To Offer';
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wik15">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="offers-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'status')->dropDownList(
            ['ACCEPTED' => 'Accept','DECLINED' => 'Decline'],
            [
                'prompt'=>'Select Your Response Status',

            ])->label("Do You Accept Or Decline The Offer") ?>

        <?= $form->field($model, 'talent_response')->textInput(['maxlength' => true])->textarea(['rows' => 5])->label("What is the reason for your response?")?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-button-D']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

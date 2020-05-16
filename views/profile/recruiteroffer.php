<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Offers */

$this->title = 'Make Offer To Talent';
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wik15">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="offers-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'offer_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true])->textarea(['rows' => 20])?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-button-C']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

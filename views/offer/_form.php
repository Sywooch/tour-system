<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'offerName')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'offerStartDate')->textInput() ?>

    <?= $form->field($model, 'offerEndDate')->textInput() ?>

    <?= $form->field($model, 'offerPrice')->textInput() ?>

    <?= $form->field($model, 'offerDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerAccommodation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerBenefits')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerProgram')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerOptional')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerNote')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerPracticalData')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerLastMinutePrice')->textInput() ?>

    <?= $form->field($model, 'offerFirstMinutePrice')->textInput() ?>

    <?= $form->field($model, 'offerIsFirstMinute')->textInput() ?>

    <?= $form->field($model, 'offerIsLastMinute')->textInput() ?>

    <?= $form->field($model, 'offerIsActive')->textInput() ?>

    <?= $form->field($model, 'countries_countryId')->textInput() ?>

    <?= $form->field($model, 'seasons_seasonId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

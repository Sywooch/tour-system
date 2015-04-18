<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'offerName')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'offerStartDate')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
    ]);?>

    <?= $form->field($model, 'offerEndDate')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
    ]);?>

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

    <?= $form->field($model, 'offerIsFirstMinute')->checkbox() ?>

    <?= $form->field($model, 'offerIsLastMinute')->checkbox() ?>

    <?= $form->field($model, 'offerIsActive')->checkbox() ?>

    <?= $form->field($model, 'countries_countryId')->textInput() ?>

    <?= $form->field($model, 'seasons_seasonId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OfferSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'offerId') ?>

    <?= $form->field($model, 'offerName') ?>

    <?= $form->field($model, 'offerStartDate') ?>

    <?= $form->field($model, 'offerEndDate') ?>

    <?= $form->field($model, 'offerPrice') ?>

    <?php // echo $form->field($model, 'offerDescription') ?>

    <?php // echo $form->field($model, 'offerAccommodation') ?>

    <?php // echo $form->field($model, 'offerBenefits') ?>

    <?php // echo $form->field($model, 'offerProgram') ?>

    <?php // echo $form->field($model, 'offerOptional') ?>

    <?php // echo $form->field($model, 'offerNote') ?>

    <?php // echo $form->field($model, 'offerPracticalData') ?>

    <?php // echo $form->field($model, 'offerLastMinutePrice') ?>

    <?php // echo $form->field($model, 'offerFirstMinutePrice') ?>

    <?php // echo $form->field($model, 'offerIsFirstMinute') ?>

    <?php // echo $form->field($model, 'offerIsLastMinute') ?>

    <?php // echo $form->field($model, 'offerIsActive') ?>

    <?php // echo $form->field($model, 'countries_countryId') ?>

    <?php // echo $form->field($model, 'seasons_seasonId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

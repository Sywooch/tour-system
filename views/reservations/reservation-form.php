<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title='Rezerwacja oferty';

$this->params['breadcrumbs'][] = ['label' => 'Rezerwacje', 'url' => ['list']]; 
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('reservationAdded')): ?>

    <div class="alert alert-success">
        Dodano now� rezerwacj�.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'reservation-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
                <?= $form->field($model2, 'attendeeName') ?>
                <?= $form->field($model2, 'attendeeSurname') ?>
                <?= $form->field($model2, 'attendeeStreet') ?>
                <?= $form->field($model2, 'attendeeSPostcode') ?>
                <?= $form->field($model2, 'attendeeCity') ?>
                <?= $form->field($model2, 'attendeePESEL') ?>
                <?= $form->field($model2, 'attendeeBirthdate')?>
                <div class="form-group">
                    <?= Html::submitButton('Utwórz klienta', ['class' => 'btn btn-success', 'name' => 'save-customer']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
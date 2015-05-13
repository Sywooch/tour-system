<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\switchinput\SwitchBox;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title='Rezerwacja oferty';

$this->params['breadcrumbs'][] = ['label' => 'Rezerwacje', 'url' => ['list']]; 
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('reservationSold')): ?>

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
             <?php   if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAgent()):?>
                <?= $form->field($model3, 'attendeeQuantity') ?>
                <?= $form->field($model4, 'customerName') ?>
                <?= $form->field($model4, 'customerSurname') ?>
                <?= $form->field($model4, 'customerStreet') ?>
                <?= $form->field($model4, 'customerPostcode') ?>
                <?= $form->field($model4, 'customerCity') ?>
                <?= $form->field($model4, 'customerPESEL') ?>
                <?= $form->field($model4, 'customerPhone') ?>
                <?= $form->field($model4, 'customerBirthdate')->widget(
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
    <?php endif; ?>
                <div class="form-group">
                    <?= Html::submitButton('Rezerwuj', ['class' => 'btn btn-success', 'name' => 'save-reservation']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
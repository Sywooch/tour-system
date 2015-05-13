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
             <?php   if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isCustomer()):?>
                <?= $form->field($model3, 'attendeeQuantity') ?>
                <?= $form->field($model3, 'userAttends')->widget(
    		SwitchBox::className(), [
    			'clientOptions' => [
    				'onText' => 'TAK',
    				'offText' => 'NIE'
    			]
    				])->label(false); ?>
                <?= $form->field($model2, 'attendeeName') ?>
                <?= $form->field($model2, 'attendeeSurname') ?>
                <?= $form->field($model2, 'attendeeStreet') ?>
                <?= $form->field($model2, 'attendeeSPostcode') ?>
                <?= $form->field($model2, 'attendeeCity') ?>
                <?= $form->field($model2, 'attendeePESEL') ?>
                <?= $form->field($model2, 'attendeeBirthdate')->widget(
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
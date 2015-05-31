<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use dosamigos\switchinput\SwitchBox;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Attendee;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title='Rezerwacja oferty';

$this->params['breadcrumbs'][] = ['label' => 'Lista ofert', 'url' => ['list']]; 
$this->params['breadcrumbs'][] = ['label' => $offerName, 'url' => ['/offer/view?id=' . $offerId]];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
		$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
	$(".dp").datepicker();
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Czy na pewno chcesz usunąć tego uczestnika?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Uczestnik usunięty!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Osiągnięto limit uczestników");
});
		');

?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('reservationAdded')): ?>

    <div class="alert alert-success">
        Dodano nową rezerwację.
    </div>
	
	 <?php elseif (Yii::$app->session->hasFlash('reservationNotAdded')): ?>

    <div class="alert alert-success">
        Nie utworzono rezerwacji. Wystąpił błąd w trakcie zapisywania do bazy danych.
    </div>
	
	<?php elseif (Yii::$app->session->hasFlash('customerAsAttendeeError')): ?>

    <div class="alert alert-success">
        Nie utworzono rezerwacji. Wystąpił błąd w trakcie zapisywania do bazy danych klienta jako uczestnika.
    </div>
	
	<?php elseif (Yii::$app->session->hasFlash('reservationNotAdded')): ?>

    <div class="alert alert-success">
        Nie utworzono rezerwacji. Wystąpił błąd w trakcie zapisywania do bazy danych któregoś uczestnika z lsity.
    </div>
	
	<?php else: ?>
	
		
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
            		'id' => 'reservation-form',
            //		'enableAjaxValidation' => 'true'
            ]); ?>
             <?php   if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isCustomer()):?>
                <?= $form->field($reservationForm, 'userAttends')->widget(
    		SwitchBox::className(), [
    			'clientOptions' => [
    				'onText' => 'TAK',
    				'offText' => 'NIE'
    			]
    				])->label(false); //   

              ?>
    				
    				<?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 999, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $attendees[0],
                'formId' => 'reservation-form',
                'formFields' => [
                    'attendeeName',
                    'attendeeSurname',
                    'attendeeStreet',
                    'attendeeSPostcode',
                	'attendeeCity',
                    'attendeePESEL',
                    'attendeeBirthdate',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($attendees as $i => $attendee): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Uczestnik </h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $attendee->isNewRecord) {
                                echo Html::activeHiddenInput($attendee, "[{$i}]attendeeId");
                            }
                        ?>
                        <div class="row">
                        	<div class="col-sm-12 col-md-4">
                        		<?= $form->field($attendee, "[{$i}]attendeeName") ?>
                        	</div>
                            <div class="col-sm-12 col-md-4">
                                <?= $form->field($attendee, "[{$i}]attendeeSurname") ?>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <?= $form->field($attendee, "[{$i}]attendeeStreet") ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-12 col-md-2">
                                <?= $form->field($attendee, "[{$i}]attendeeSPostcode") ?>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <?= $form->field($attendee, "[{$i}]attendeeCity") ?>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <?= $form->field($attendee, "[{$i}]attendeePESEL") ?>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <?= $form->field($attendee, "[{$i}]attendeeBirthdate")->widget(DatePicker::className(),[
                		'language' => 'pl',
                		'dateFormat' => 'yyyy-MM-dd',
                		'options'=>['class'=>'form-control dp']
			    ]);
                                 ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); 
            
            ////////////////////////////////////////////////////////////////////?>
    				
    				
               
    <?php endif; ?>
                <div class="form-group text-center">
                    <?= Html::submitButton('Rezerwuj', ['class' => 'btn btn-success', 'name' => 'save-reservation']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\switchinput\SwitchBox;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Attendee;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title='Rezerwacja oferty';

$this->params['breadcrumbs'][] = ['label' => 'Rezerwacje', 'url' => ['list']]; 
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
		$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
		');
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
    				])->label(false); //   

                 
                 //////////////////////////////////////////////////////////?>
    				
    				<?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 999, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $model2[0],
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
            <?php foreach ($model2 as $i => $models2): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Uczestnik</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $models2->isNewRecord) {
                                echo Html::activeHiddenInput($models2, "[{$i}]attendeeId");
                            }
                        ?>
                        <?= $form->field($models2, "[{$i}]attendeeName") ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($models2, "[{$i}]attendeeSurname") ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($models2, "[{$i}]attendeeStreet") ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($models2, "[{$i}]attendeeSPostcode") ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($models2, "[{$i}]attendeeCity") ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($models2, "[{$i}]attendeePESEL") ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($models2, "[{$i}]attendeeBirthdate")->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
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
                <div class="form-group">
                    <?= Html::submitButton('Rezerwuj', ['class' => 'btn btn-success', 'name' => 'save-reservation']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
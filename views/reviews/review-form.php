<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\tinymce\TinyMce;

	$this->title = 'Twoja Opinia';

$this->params['breadcrumbs'][] = ['label' => 'Opinia', 'url' => ['list']]; //akcja lista?
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('reviewAdded')): ?>

    <div class="alert alert-success">
        Twoja recenzja została dodana.
    </div>
	
	<?php else: ?>  
	
	 <?php if (Yii::$app->session->hasFlash('OfferNotEnd')): ?>

    <div class="alert alert-danger">
        Opinię można wystawić dopiero po zakończeniu wycieczki.
    </div>
	
	<?php else: ?>  
	
	 <?php if (Yii::$app->session->hasFlash('reviewExists')): ?>
	
	<div class="alert alert-danger">
        Opinia została już wystawiona.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'review-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
            	<?= $form->field($model, 'reservations_reservationId') ?>
                <?= $form->field($model, 'reviewDescription')/*->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        
        'toolbar' => "undo redo | styleselect | bold italic"
    ]
])*/ ?>
                <div class="form-group">
                    <?= Html::submitButton('Wystaw opinię', ['class' => 'btn btn-success', 'name' => 'review-accept']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
</div>
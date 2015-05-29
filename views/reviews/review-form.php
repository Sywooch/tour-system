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
        Twoja recenzja zostaĹ‚a dodana.
    </div>
	
	<?php else: ?>  
	
	 <?php if (Yii::$app->session->hasFlash('OfferNotEnd')): ?>

    <div class="alert alert-danger">
        OpiniÄ™ moĹĽna wystawiÄ‡ dopiero po zakoĹ„czeniu wycieczki.
    </div>
	
	<?php else: ?>  
	
	 <?php if (Yii::$app->session->hasFlash('reviewExists')): ?>
	
	<div class="alert alert-danger">
        Opinia zostaĹ‚a juĹĽ wystawiona.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'review-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
            	<?= $form->field($model, 'reservations_reservationId')->hiddenInput()->label(fale) ?>
                <?= $form->field($model, 'reviewDescription')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        
        'toolbar' => "undo redo | styleselect | bold italic"
    ]
]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Wystaw opiniÄ™', ['class' => 'btn btn-success', 'name' => 'review-accept']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
</div>
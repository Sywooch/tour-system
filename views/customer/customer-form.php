<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

if($model1->isNewRecord){
	$this->title = 'Dodawanie nowego klienta';
}else{
	$this->title = 'Edytowanie danych użytkownika ' . $model1->userLogin;
}

$this->params['breadcrumbs'][] = ['label' => 'Klienci', 'url' => ['list']]; //akcja lista?
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('customerAdded')): ?>

    <div class="alert alert-success">
        Dodano nowego klienta.
    </div>
	
	<?php else: ?>  
	
	 <?php if (Yii::$app->session->hasFlash('customerEdited')): ?>

    <div class="alert alert-success">
        Edytowano dane użytkownika.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'customer-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
                <?= $form->field($model1, 'userLogin') ?>
                <?= $form->field($model1, 'userPassword')->passwordInput() ?>
                <?= $form->field($model1, 'userEmail') ?>
                <?= $form->field($model2, 'customerName') ?>
                <?= $form->field($model2, 'customerSurname') ?>
                <?= $form->field($model2, 'customerBirthdate') ?>
                <?= $form->field($model2, 'customerPESEL') ?>
                <?= $form->field($model2, 'customerPhone') ?>
                <?= $form->field($model2, 'customerStreet') ?>
                <?= $form->field($model2, 'customerCity')?>
                <?= $form->field($model2, 'customerPostcode')?>
                <div class="form-group">
                    <?= Html::submitButton($model1->isNewRecord ? 'Utwórz klienta' : 'Zapisz zmiany', ['class' => 'btn btn-success', 'name' => 'save-customer']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
    <?php endif; ?>
</div>
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title='Dodawanie nowego pracownika';

$this->params['breadcrumbs'][] = ['label' => 'Pracownicy', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('personnelAdded')): ?>

    <div class="alert alert-success">
        Dodano nowego pracownika.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'personnel-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
                <?= $form->field($model1, 'userLogin') ?>
                <?= $form->field($model1, 'userPassword') ?>
                <?= $form->field($model1, 'userEmail') ?>
                <?= $form->field($model2, 'agentName') ?>
                <?= $form->field($model2, 'agentSurname') ?>
                <div class="form-group">
                    <?= Html::submitButton('Dodaj pracownika', ['class' => 'btn btn-success', 'name' => 'save-personnel']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title='Dodawanie nowego agenta';

$this->params['breadcrumbs'][] = ['label' => 'Agenci', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('agentAdded')): ?>

    <div class="alert alert-success">
        Dodano nowego agenta.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'agent-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
                <?= $form->field($model1, 'userLogin') ?>
                <?= $form->field($model1, 'userPassword')->passwordInput() ?>
                <?= $form->field($model1, 'userEmail') ?>
                <?= $form->field($model2, 'agentName') ?>
                <?= $form->field($model2, 'agentSurname') ?>
                <div class="form-group">
                    <?= Html::submitButton('Utwórz agenta', ['class' => 'btn btn-success', 'name' => 'save-agent']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
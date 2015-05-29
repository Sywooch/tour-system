<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

if($model->isNewRecord){
	$this->title = 'Dodawanie kontrahenta';
}else{
	$this->title = 'Edytowanie kontrahenta:' . $model->contractorShortName;
}
$this->params['breadcrumbs'][] = ['label' => 'Kontrahenci', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contractorAdded')): ?>

    <div class="alert alert-success">
        Dodawanie kontrahenta zakończone sukcesem.
    </div>
	<?php else: ?>
		    
	<?php if (Yii::$app->session->hasFlash('contractorEdited')): ?>

    <div class="alert alert-success">
        Edycja danych kontrahenta zakończone sukcesem.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'contractor-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
                <?= $form->field($model, 'contractorShortName') ?>
                <?= $form->field($model, 'contractorFullName') ?>
                <?= $form->field($model, 'contractorStreet') ?>
                <?= $form->field($model, 'contractorPostcode') ?>
                <?= $form->field($model, 'contractorCity') ?>
                <?= $form->field($model, 'contractorCountry') ?>
                <?= $form->field($model, 'contractorNIP')?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Utwórz kontrahenta' : 'Zapisz zmiany', ['class' => 'btn btn-success', 'name' => 'save-contractor']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
    <?php endif; ?>
</div>

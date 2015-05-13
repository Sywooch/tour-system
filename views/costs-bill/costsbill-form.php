<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use app\models\Offer;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

if($model->isNewRecord){
	$this->title = 'Dodawanie dokumentu kosztowego';
}else{
	$this->title = 'Edytowanie dokumentu kosztowego';
}
$this->params['breadcrumbs'][] = ['label' => 'Dokumenty kosztowe', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;

$contractors = app\models\Contractor::find()
->select('contractorId as id, contractorShortName as label, contractorShortName as value')
->asArray()
->all();

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('costsBillAdded')): ?>

    <div class="alert alert-success">
        Dodawanie dokumentu kosztowego zakończone sukcesem.
    </div>
	<?php else: ?>
		    
	<?php if (Yii::$app->session->hasFlash('costsBillEdited')): ?>

    <div class="alert alert-success">
        Edycja dokumentu kosztowego zakończona sukcesem.
    </div>
	
	<?php else: ?>    
		
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'contractor-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
            	<?= $form->field($model, 'settlements_offerId')->dropDownList(
        				ArrayHelper::map(Offer::find()->all(),'offerId','offerName'),
        				['prompt' => 'Wybierz ofertę, której dokument dotyczy']
   				 ) ?>
                <?= $form->field($model, 'costsBillDate')->widget(DatePicker::className(),[
                		'language' => 'pl',
                		'dateFormat' => 'yyyy-MM-dd',
                		'options'=>['class'=>'form-control']
			    ]) ?>
			    <?= $form->field($model, 'costsBillNo') ?>
			    <label class="control-label" for="ac">Nazwa skrócona kontrahenta</label>
			    <?= AutoComplete::widget([
			    		'options' => ['class' => 'form-control', 'id' => 'ac'],
			    		'value' => (!$model->isNewRecord ? $model->getContractor()->one()->contractorShortName : ''),
			    		'clientOptions' => [
				    	'autofill' => true,
			    		'source' => $contractors,
			    		'select' => new JsExpression("function( event, ui ) {
        $($(this).parent().find('input[name=\"CostsBill[contractors_contractorId]\"]')).val(ui.item.id);
     }"),
			    ],]) ?>
			    <?= $form->field($model, 'contractors_contractorId')->hiddenInput()->label(false) ?>
			    <?= $form->field($model, 'costsBillDescription') ?>
			    <?= $form->field($model, 'costsBillValue') ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Zapisz dokument' : 'Zapisz zmiany', ['class' => 'btn btn-success', 'name' => 'save-contractor']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
    <?php endif; ?>
</div>

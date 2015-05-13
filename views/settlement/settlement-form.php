<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this y. ii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$contractors = app\models\Contractor::find()
->select('contractorId as id, contractorShortName as label, contractorShortName as value')
->asArray()
->all();

$counter = 0;

$this->registerJs('
	var counter = 0;
	$("#add-bill").on("click", function(){
		counter++;
		console.log("w" + counter);
		
		$("#costs-bills").append("<tr>" +
		"<td>" +
		"<div class=\'form-group field-costbill-" + counter + "-costbilldate required\'>" +
		"<input type=\'text\' id=\'costsbill-" + counter + "-costsbilldate\' name=\'CostsBill[" + counter + "][costsBillDate]\' class=\'form-control dp\'>" +
		"<p class=\'help-block help-block-error\'></p>" + 
		"</div>" +
		"</td>" +
		"<td>" +
		"<div class=\'form-group field-costbill-" + counter + "-costbillno required\'>" +
		"<input type=\'text\' id=\'costsbill-" + counter + "-costsbillno\' name=\'CostsBill[" + counter + "][costsBillNo]\' class=\'form-control\'>" +
		"<p class=\'help-block help-block-error\'></p>" + 
		"</div>" +
		"</td>" +
		"<td>" +
		"<input type=\'text\' id=\'w" + counter + "\' class=\'form-control ac\'>" +
		"<div class=\'form-group field-costbill-" + counter + "-contractors_contractorid required\'>" +
		"<input type=\'hidden\' id=\'costsbill-" + counter + "-contractors_contractorid\' name=\'CostsBill[" + counter + "][contractors_contractorId]\' class=\'form-control\'>" +
		"<p class=\'help-block help-block-error\'></p>" + 
		"</div>" +
		"</td>" +
		"<td>" +
		"<div class=\'form-group field-costbill-" + counter + "-costbilldescription required\'>" +
		"<input type=\'text\' id=\'costsbill-" + counter + "-costsbilldescription\' name=\'CostsBill[" + counter + "][costsBillDescription]\' class=\'form-control\'>" +
		"<p class=\'help-block help-block-error\'></p>" + 
		"</div>" +
		"</td>" +
		"<td>" +
		"<div class=\'form-group field-costbill-" + counter + "-costbillvalue required\'>" +
		"<input type=\'text\' id=\'costsbill-" + counter + "-costsbillvalue\' name=\'CostsBill[" + counter + "][costsBillValue]\' class=\'form-control\'>" +
		"<p class=\'help-block help-block-error\'></p>" + 
		"</div>" +
		"</td>" +
		"<td class=\'text-center delete\'><div class=\'glyphicon glyphicon-trash\'></div></td>" +
		"</tr>");
		$(".delete").on("click", function(){
			var $killrow = $(this).parent("tr");
			$killrow.addClass("danger");
			$killrow.fadeOut(2000, function(){
				$(this).remove();
			});
		});
		
		$("#costs-bills .dp").datepicker();
		$("#costs-bills .ac").autocomplete(
		{
			source:'
			. json_encode($contractors) . ',
			select: function(event, ui) {
				$($(this).parent().find(\'input[name="CostsBill[' . $counter . '][contractors_contractorId]"]\')).val(ui.item.id);
			}
		});
	});
		
	$(".delete").on("click",function(){
		var $killrow = $(this).parent("tr");
    	$killrow.addClass("danger");
		$killrow.fadeOut(2000, function(){
    	$(this).remove();
		});
	})'
);

$this->registerCss('.delete{ cursor: pointer; color: #337ab7;} .delete:hover{color: #0D5491;}');

$this->title = 'Dodawanie rozliczenia';

$this->params['breadcrumbs'][] = ['label' => 'Rozliczenia', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'settlement-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
                <?= $form->field($settlement, 'settlementNo') ?>
                <?= $form->field($settlement, 'settlementDate')->widget(
        DatePicker::className(), [
        'language' => 'pl',
        'dateFormat' => 'yyyy-MM-dd'
    ]); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			    <table class="table table-striped" id="costs-bills">
			    	<tr>
			    		<th>Data wystawienia dokumentu</th>
			    		<th>Numer dokumentu</th>
			    		<th>Kontrahent</th>
			    		<th>Opis zdarzenia</th>
			    		<th>Wartość brutto</th>
			    		<th>Usuń</th>
			    	</tr>
			    	<tr>
			    		<td><?= $form->field($costsBill, '[0]costsBillDate')->widget(DatePicker::className(),[
			    				'language' => 'pl',
			    				'dateFormat' => 'yyyy-MM-dd'
			    		])->label(false) ?></td>
			    		<td><?= $form->field($costsBill, '[0]costsBillNo')->label(false) ?></td>
			    		<td><?= AutoComplete::widget([
				    				'clientOptions' => [
				    					'autofill' => true,
			    						'source' => $contractors,
			    						'select' => new JsExpression("function( event, ui ) {
        $($(this).parent().find('input[name=\"CostsBill[0][contractors_contractorId]\"]')).val(ui.item.id);
     }")
			    				],]) ?>
			    			<?= $form->field($costsBill, '[0]contractors_contractorId')->hiddenInput()->label(false) ?>
			    		</td>
			    		<td><?= $form->field($costsBill, '[0]costsBillDescription')->label(false) ?></td>
			    		<td><?= $form->field($costsBill, '[0]costsBillValue')->label(false) ?></td>
			    		<td class="text-center delete"><div class="glyphicon glyphicon-trash"></div></td>
			    	</tr>
			    </table>
			    <div class="text-center">
			    	<?= Html::button('Dodaj pozycję księgowania', $options = ['id' => 'add-bill', 'class' => 'btn btn-primary']) ?>
			    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">	    
                <div class="form-group">
                    <?= Html::submitButton('Zapisz rozliczenie', ['class' => 'btn btn-success', 'name' => 'save-contractor']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

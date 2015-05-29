<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use app\models\Reservation;

/* @var $this y. ii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->registerCss('.delete{ cursor: pointer; color: #337ab7;} .delete:hover{color: #0D5491;}');

$this->title = 'Dodawanie rozliczenia';

$this->params['breadcrumbs'][] = ['label' => 'Lista ofert', 'url' => ['/offer/list']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if (Yii::$app->session->hasFlash('settlementAdded')): ?>

    <div class="alert alert-success">
        Zapisywanie rozliczenia zakończone sukcesem.
    </div>
 <?php elseif (Yii::$app->session->hasFlash('settlementError')): ?>
 	 <div class="alert alert-error">
        Zapisywanie rozliczenia zakończone niepowodzeniem.
    </div>
<?php endif;?>

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
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class'=>'form-control']
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
		    	</tr>
				<?php 
					foreach($costsBills as $costBill){
						$row = <<<ROW
				<tr>
					<td>{$costBill->costsBillDate}</td>
					<td>{$costBill->costsBillNo}</td>
					<td>{$costBill->getContractor()->one()->contractorFullName}, {$costBill->getContractor()->one()->contractorStreet}, 
					{$costBill->getContractor()->one()->contractorPostcode} {$costBill->getContractor()->one()->contractorCity}, 
					NIP: {$costBill->getContractor()->one()->contractorNIP}</td>
					<td>{$costBill->costsBillDescription}</td>
					<td>{$costBill->costsBillValue}</td>
				</tr>
ROW;
					echo $row;
					}
				?>
		    </table>
		</div>
		<div class="col-lg-5">
		    <?= $form->field($settlement, 'settlementTotalIncome')->textInput(['readonly' => true]) ?>
		    <?= $form->field($settlement, 'settlementCosts')->textInput(['readonly' => true]) ?>
			<div class="form-group">		
				<label class="control-label" for="margin">Marża brutto</label>
				<?php ($settlement->settlementTotalIncome - $settlement->settlementCosts > 0) ? $margin = $settlement->settlementTotalIncome - $settlement->settlementCosts : $margin = 0 ;?>
				<?= Html::textInput('margin', $margin, 
						['disabled' => true, 
						 'class' => 'form-control',
						 'id' => 'margin'
				]) ?>
			</div>
			<?= $form->field($settlement, 'settlementVAT')->textInput(['readonly' => true]) ?>
			<div class="form-group">		
				<label class="control-label" for="vat">Marża netto</label>
				<?= Html::textInput('vat', ($margin - $settlement->settlementVAT), 
						['disabled' => true, 
						 'class' => 'form-control',
						 'id' => 'vat'
				]) ?>
			</div>
			<?= $form->field($settlement, 'offers_offerId')->hiddenInput()->label(false) ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">	    
                <div class="form-group">
                    <?= Html::submitButton('Zapisz rozliczenie', ['class' => 'btn btn-success', 'name' => 'save-contractor']) ?>
                    <?= Html::a('Pobierz PDF', 'report?id=' . $settlement->offers_offerId, ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PaymentMethod;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

	$this->title = 'Faktura';

$this->params['breadcrumbs'][] = ['label' => 'Faktura', 'url' => ['list']]; //akcja lista?
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
		
	<?php if (Yii::$app->session->hasFlash('invoiceAdded')): ?>

    <div class="alert alert-success">
        Dodano fakture.
    </div>
    <div class="form-group">
                    <?=Html::a('Generuj PDF', ['/customer/generate-invoice?invoiceNo=' . ($invoice->customerInvoiceNo-1).'/'.date('Y')], ['class' => 'btn btn-primary']); ?>
                </div>
	
	<?php else: ?>	
	
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
            		'id' => 'invoice-form',
            		'enableAjaxValidation' => 'true'
            ]); ?>
                <?= $form->field($invoice, 'customerInvoiceNo') ?>
                <?= $form->field($invoice, 'customerInvoiceDate') ?>          
                <?= $form->field($reservation->getCustomers()->one(), 'customerName')->textInput(['readonly' => true]) ?>
                <?= $form->field($reservation->getCustomers()->one(), 'customerSurname')->textInput(['readonly' => true]) ?>
                <?= $form->field($invoice, 'customerInvoiceDateOfSale')->textInput(['readonly' => true]) ?>
                <?= $form->field($invoice, 'paymentMethods_paymentMethodId')->dropDownList(
        		ArrayHelper::map(PaymentMethod::find()->all(),'paymentMethodId','paymentMethodName'),
        		['prompt' => 'Wybierz sposób płatności']) ?>
        		<?= $form->field($invoice, 'customerInvoicePaymentDate')->widget(
        			DatePicker::className(), [
        			'inline' => false,
        			'clientOptions' => [
           			'autoclose' => true,
            		'format' => 'yyyy-m-d']]);?>
                
                <div class="form-group">
                    <?= Html::submitButton('Wystaw fakturę', ['class' => 'btn btn-success', 'name' => 'save-invoice']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
     <?php endif; ?>
</div>
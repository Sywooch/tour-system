<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Country;
use app\models\Season;
use app\models\Payment;
use app\models\PaymentMethod;
use dosamigos\datepicker\DatePicker;
use dosamigos\switchinput;
use dosamigos\tinymce\TinyMce;
use dosamigos\switchinput\SwitchBox;?>

<div class="payment-form">
<?php
$this->title = 'Dodaj płatność';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-list">
	<h1><?= Html::encode($this->title) ?></h1></div>
    
	<br />
    
    
    <?php if (Yii::$app->session->hasFlash('paymentAdded')): ?>

    <div class="alert alert-success">
        Dodano nową płatność.
    </div>
    <?php else: ?>
	<?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($payment, 'paymentDate')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
    ]);?>

    

    <?= $form->field($payment, 'paymentValue')->textInput() ?>


    <?= $form->field($payment, 'paymentMethods_paymentMethodId')->dropDownList(
        ArrayHelper::map(PaymentMethod::find()->all(),'paymentMethodId','paymentMethodName'),
        ['prompt' => 'Wybierz sposób płatności']
    ) ?>

      <div class="form-group">
                    <?= Html::submitButton('Dodaj płatność', ['class' => 'btn btn-success', 'name' => 'save-payment']) ?>
                </div>

    <?php ActiveForm::end(); ?>
<?php endif; ?>
</div>

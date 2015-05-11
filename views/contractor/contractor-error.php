<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

if(Yii::$app->session->hasFlash('contractorAddAttempt')){
	$this->title = 'Dodawanie kontrahenta';
}else{
	$this->title = 'Edytowanie kontrahenta:';
}
$this->params['breadcrumbs'][] = ['label' => 'Kontrahenci', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contractorAddAttempt')): ?>

    <div class="alert alert-danger">
        Nie można dodać kontrahenta. Brak uprawnień. Tylko personel biura może wykonać tą akcję.
    </div>
	<?php else: ?>
		    
	<?php if (Yii::$app->session->hasFlash('contractorEditAttempt')): ?>

    <div class="alert alert-danger">
        Nie można edytować kontrahenta. Brak uprawnień. Tylko personel biura może wykonać tą akcję.
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

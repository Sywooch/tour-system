<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

if(Yii::$app->session->hasFlash('contractorAddAttempt')){
	$this->title = 'Dodawanie dokumentu kosztowego';
}else{
	$this->title = 'Edytowanie dokumentu kosztowego';
}
$this->params['breadcrumbs'][] = ['label' => 'Dokumenty kosztowe', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('costsBillAddAttempt')): ?>

    <div class="alert alert-danger">
        Nie można dodać dokumentu kosztowego. Brak uprawnień. Tylko personel biura może wykonać tą akcję.
    </div>
	<?php else: ?>
		    
	<?php if (Yii::$app->session->hasFlash('costsBillEditAttempt')): ?>

    <div class="alert alert-danger">
        Nie można edytować dokumentu kosztowego. Brak uprawnień. Tylko personel biura może wykonać tą akcję.
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

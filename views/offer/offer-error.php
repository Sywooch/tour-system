<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

if(Yii::$app->session->hasFlash('offerAddAttempt')){
	$this->title = 'Dodawanie oferty';
}else{
	$this->title = 'Edytowanie oferty:';
}
$this->params['breadcrumbs'][] = ['label' => 'Oferty', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('offerAddAttempt')): ?>

    <div class="alert alert-danger">
        Nie można dodać oferty. Brak uprawnień. 
    </div>
	<?php else: ?>
		    
	<?php if (Yii::$app->session->hasFlash('offerEditAttempt')): ?>

    <div class="alert alert-danger">
        Nie można edytować oferty. Brak uprawnień.
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

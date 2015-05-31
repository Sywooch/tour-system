<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Dodawanie zdjęć';
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $offerName, 'url' => ['view?id=' . $offerId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-add-photo">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (Yii::$app->session->hasFlash('photosAdded')): ?>

    <div class="alert alert-success">
        Dodawanie zdjęć do oferty zakończone sukcesem.
    </div>
    
    <?php else: ?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true]) ?>

    <button>Dodawanie zdjęć</button>

<?php ActiveForm::end() ?>
</div>
<?php endif;?>
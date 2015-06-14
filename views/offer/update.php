<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Edycja oferty: ' . ' ' . $model->offerName;
$this->params['breadcrumbs'][] = ['label' => 'Lista ofert', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->offerName, 'url' => ['view', 'id' => $model->offerId]];
$this->params['breadcrumbs'][] = 'Edycja';
?>
<div class="offer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

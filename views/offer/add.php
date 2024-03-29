<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Dodawanie oferty';
$this->params['breadcrumbs'][] = ['label' => 'Lista ofert', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

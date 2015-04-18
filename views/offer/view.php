<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = $model->offerId;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->offerId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->offerId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'offerId',
            'offerName',
            'offerStartDate',
            'offerEndDate',
            'offerPrice',
            'offerDescription:ntext',
            'offerAccommodation:ntext',
            'offerBenefits:ntext',
            'offerProgram:ntext',
            'offerOptional:ntext',
            'offerNote:ntext',
            'offerPracticalData:ntext',
            'offerLastMinutePrice',
            'offerFirstMinutePrice',
            'offerIsFirstMinute',
            'offerIsLastMinute',
            'offerIsActive',
            'countries_countryId',
            'seasons_seasonId',
        ],
    ]) ?>

</div>
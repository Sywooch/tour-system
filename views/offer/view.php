<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = $model->offerName;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php 
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isPersonnel()) {
    	Html::a('Update', ['update', 'id' => $model->offerId], ['class' => 'btn btn-primary']);
    }
    ?>
        
        <?= Html::a(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAgent() ? 
        		'Sprzedarz' : 
        		'Rezerwacja', !Yii::$app->user->isGuest && (Yii::$app->user->identity->isAgent() || Yii::$app->user->identity->isPersonnel()) ? 
        		['/agent/sell', 'id' => $model->offerId] : 
        		Yii::$app->user->isGuest ? 
        		['/site/login'] : 
        		['/customer/buy', 'id' => $model->offerId], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'offerName',
            'offerStartDate',
            'offerEndDate',
            'offerPrice',
            'offerLastMinutePrice',
            'offerFirstMinutePrice',
            'offerIsFirstMinute',
            'offerIsLastMinute',
            'offerIsActive',
            'countriesCountry.countryName',
            'seasonsSeason.seasonName',
        ],
    ]) ?>

    <?= Tabs::widget([
            'items' => [
                [
                    'label' => 'Opis oferty',
                    'content' => $model->offerDescription,
                    'active' => true
                ],
                [
                    'label' => 'Offer Accommodation',
                    'content' => $model->offerAccommodation,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-accomodation'],
                ],
                [
                    'label' => 'Korzyści oferty',
                    'content' => $model->offerBenefits,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-benefits'],
                ],
                [
                    'label' => 'Programa oferty',
                    'content' => $model->offerProgram,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-program'],
                ],
                [
                    'label' => 'Offer Optional',
                    'content' => $model->offerOptional,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-optiona'],
                ],
                [
                    'label' => 'Offer Note',
                    'content' => $model->offerNote,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-note'],
                ],
                [
                    'label' => 'Offer Practical Data',
                    'content' => $model->offerPracticalData,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-practical-data'],
                ],
            ],
        ]);
    ?>
</div>

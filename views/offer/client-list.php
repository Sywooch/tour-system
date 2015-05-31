<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista ofert';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
	 <?php 
	 if (Yii::$app->user->isGuest || Yii::$app->user->identity->isCustomer() || Yii::$app->user->identity->isAgent()) {
	 	$template = '{view}';
	 } else {
	 	$template = '{view} {update} {settlement}';
	 }
	 ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'offerId',
            'offerName',
            'offerStartDate',
            'offerEndDate',
            'offerPrice',
            //'offerDescription:ntext',
            //'offerAccommodation:ntext',
            //'offerBenefits:ntext',
            //'offerProgram:ntext',
            //'offerOptional:ntext',
            //'offerNote:ntext',
            //'offerPracticalData:ntext',
            //'offerLastMinutePrice',
            //'offerFirstMinutePrice',
            //'offerIsFirstMinute',
            //'offerIsLastMinute',
            //'offerIsActive',
            //'countriesCountry.countryName',
            //'seasonsSeason.seasonName',

            ['class' => 'yii\grid\ActionColumn',
             'template'=> $template,
             'buttons' => [
             		'settlement' => function($url,$model) {
             		$icon = '<span class="glyphicon glyphicon-usd"></span>';
             		$label = 'Rozliczenie oferty';
             		$url = "/settlement/add?id=" . $model->offerId;
             		return Html::a($icon, $url, ['title' => $label, 'aria-label' => $label]);
        			}
        	 ]
        ],
        ],
    ]); ?>

</div>

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
    <?php 
		$i = $pagination->page*10 + 1;
		echo '<div class="hidden-xs hidden-sm">';
   		foreach ($offers as $offer) {
   			echo '<div class="row" style="border: 1px solid grey;">';
   			echo '<div class="col-xs-3 col-md-2">';
				if($offer->getImages()->count() != 0){
					echo Html::a('<img src="' . $offer->getImages()->one()->image_path . '" class="img-thumbnail" style="max-width: 170px; height: auto;">',
							'view?id=' . $offer->offerId);
					
				}else echo '&nbsp;';
				echo '</div>';
				echo '<div class="col-xs-9 col-md-10"><div class="row">';
				echo Html::a('<h3>' . $offer->offerName . '</h3>',
						'view?id=' . $offer->offerId);
				echo '<div class="col-md-3"><strong>Jedziemy do: </strong>' . $offer->getCountriesCountry()->one()->countryName . '</div>';
				echo '<div class="col-md-3"><strong>Data wyjazdu: </strong>' . $offer->offerStartDate . '</div>';
				echo '<div class="col-md-3"><strong>Data powrotu: </strong>' . $offer->offerEndDate . '</div>';
				echo '<div class="col-md-3 lead"><strong class="pull-right">';
				if($offer->offerIsFirstMinute != 1 && $offer->offerIsLastMinute != 1) echo $offer->offerPrice . " zł";
				else{
					echo '<s>' . $offer->offerPrice . ' zł' . '</s><br><span class="pull-right" style="color: green">';
					echo $offer->getPrice() . " zł";
				}
				echo '</strong></div>';
				echo '</div></div></div>';
   		}
   		echo '</div>';
   		
   		echo '<div class="hidden-md hidden-lg">';
   		foreach ($offers as $offer) {
   			echo '<div class="row" style="border: 1px solid grey;">';
   			echo '<div class="col-xs-12">';
   			echo Html::a('<h3>' . $offer->offerName . '</h3>',
   					'view?id=' . $offer->offerId);
   			echo '<div class="col-md-6"><strong>Jedziemy do: </strong>' . $offer->getCountriesCountry()->one()->countryName . '</div>';
   			echo '<div class="col-md-6"><strong>Data wyjazdu: </strong>' . $offer->offerStartDate . '</div>';
   			echo '<div class="col-md-6"><strong>Data powrotu: </strong>' . $offer->offerEndDate . '</div>';
   			echo '<div class="col-md-6 lead"><strong class="pull-right">Cena: ';
   			if($offer->offerIsFirstMinute != 1 && $offer->offerIsLastMinute != 1) echo $offer->offerPrice . " zł";
   			else{
   				echo '<s>' . $offer->offerPrice . ' zł' . '</s><br><span class="pull-right" style="color: green">';
   				echo $offer->getPrice() . " zł";
   			}
   			echo '</strong></div>';
   			echo '</div></div>';
   		}
   		echo '</div>';
   	?>
</div>

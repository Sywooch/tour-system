<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Twoje rezerwacje';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-list">
	<h1><?= Html::encode($this->title) ?></h1>
    <?php 
		$i = $pagination->page*10 + 1;
		foreach ($reservations as $reservation) {
   			echo '<div class="row" style="border: 1px solid grey;">';
   			echo Html::a('<h3>Rezerwacja oferty: ' . $reservation->getOffers()->one()->offerName . '</h3>',
					'reservation-detail?id=' . $reservation->reservationId);
			echo '<div class="col-xs-6 col-md-3"><strong>Nr rezerwacji: </strong><br>' . $reservation->reservationId . '</div>';
			echo '<div class="col-xs-6 col-md-3"><strong>Data rezerwacji: </strong><br>' . $reservation->reservationDate . '</div>';
			echo '<div class="col-xs-6 col-md-3"><strong>Liczba osób: </strong><br>' . $reservation->getAttendees()->count() . '</div>';
			echo '<div class="col-xs-6 col-md-3 lead"><strong class="pull-right">Do zapłaty: ' . $reservation->reservationPricePerAtendee . " zł";
			$color = 'green';
			if($reservation->reservationPricePerAtendee != $reservation->getPaymentsValue()) $color ='red';
			echo '<br><span style="color: ' . $color . ';">   Zapłacono: ' . $reservation->getPaymentsValue() . " zł</span>";
			echo '</strong></div>';
			echo '</div>';
   		}
   	?>
   	<?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>

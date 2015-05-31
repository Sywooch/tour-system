<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\ButtonDropdown;

$this->title = 'Twoje rezerwacje';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('
		.item {
			border-bottom: 1px solid black !important;
		}

		.item:last-child {
			border-bottom: none !important;
		}
		');
?>
<div class="reservations-list">
	<h1><?= Html::encode($this->title) ?></h1>
    <?php 
		$i = $pagination->page*10 + 1;
		foreach ($reservations as $reservation) {
   			echo '<div class="row item"><div style="vertical-align: middle">';
   			echo Html::a('<h3 class=".h3" style="float: left">Rezerwacja oferty: ' . $reservation->getOffers()->one()->offerName . '</h3>',
					'reservation-detail?id=' . $reservation->reservationId);
   			echo '&nbsp;&nbsp;&nbsp;';
   			echo ButtonDropdown::widget([
   					'label' => 'Akcja',
   					'dropdown' => [
   							'items' => [
   									['label' => 'Pobierz umowę', 'url' => 'agreement'],
   									['label' => 'Dodaj opinię', 'url' => '/offer/reservation?id=' . $reservation->reservationId],
        							['label' => ($reservation->reservationInvoiced != 0) ? 'Pobierz fakturę' : '', 
        							 'url' => ($reservation->reservationInvoiced != 0) ? 'generate-invoice?invoiceNo=' . 
        									$reservation->getCustomerInvoice()->one()->customerInvoiceNo : ''
        							],
   							],
   					],
   					'containerOptions' => [
   							'tag' => 'div',
   							'class' => 'hidden-xs hidden-sm',
   							'style' => 'margin-top: 15px',
   					],
   					'options' =>[
   							'class' => 'btn btn-primary'
   					]
   			]);
			echo '<div style="clear:both"></div></div><div class="col-xs-6 col-md-3"><strong>Nr rezerwacji: </strong><br>' . $reservation->reservationId . '</div>';
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

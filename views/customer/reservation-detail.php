<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\jui\Accordion;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Rezerwacja nr: ' . $reservation->reservationId;
$this->params['breadcrumbs'][] = ['label' => 'Moje rezerwacje', 'url' => ['reservations']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
    <div class="btn-group text-center" role="group">
    <?php 
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isCustomer()) {
    
    	echo Html::a('Pobierz umowę', ['agreement', 'id' => $reservation->reservationId], ['class' => 'btn btn-primary', 'role' => 'button']);
        echo Html::a('Dodaj opinię', ['addimage', 'id' => $reservation->reservationId], ['class' => 'btn btn-primary', 'role' => 'button']);
        if($reservation->reservationInvoiced != 0){
        	echo Html::a('Pobierz fakturę', ['addimage', 'id' => $reservation->reservationId], ['class' => 'btn btn-primary', 'role' => 'button']);
        }
    }
    ?>
     </div>
     <br><br>
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
    <br><br>
    <?php
    	$i = 1;
    	$attendees = '';
    	foreach($reservation->getAttendees() as $attendee){
    		$attendees .= "<h4>Uczestnik " . $i . ":</h4>";
    		$attendees .= '<ol>';
    		$attendees .= '<li><strong>Imię i nazwisko: </strong>' . $attendee->attendeeName . ' ' . $attendee->attendeeSurname . '</li>';
    		$attendees .= '<li><strong>Adres zamieszkania: </strong>' . $attendee->attendeeStreet . ' ' 
						. $attendee->attendeeSPostcode . ' ' . $attendee->attendeeCity . '</li>';
    		$attendees .= '<li><strong>PESEL: </strong>' . $attendee->attendeePESEL . '</li>';
    		$attendees .= '<li><strong>Data urodzenia: </strong>' . $attendee->attendeeBirthdate . '</li>';
    		$attendees .= '</ol>';
    		$i++;
    	}
    	
    	$i = 1;
    	$payments = '';
    	foreach($reservation->getPayments as $payment){
    		$payments .= "<h4>Płatność " . $i . ":</h4>";
    		$payments .= '<ol>';
    		$payments .= '<li><strong>Kwota: </strong>' . $payment->paymentValue . ' zł</li>';
    		$payments .= '<li><strong>Data płatności: </strong>' . $payment->getPaymentgetPaymentMethodsPaymentMethod()->one()->paymentName . '</li>';;
    		$payments .= '</ol>';
    		$i++;
    	}
    ?>
    
    
    <?= Tabs::widget([
            'items' => [
                [
                    'label' => 'Uczestnicy',
                    'content' => $attendees,
                    'active' => true
                ],
                [
                    'label' => 'Płatności',
                    'content' => $payments,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-accomodation'],
                ]
            ],
    		'options' => ['class' => 'hidden-sm hidden-xs'],
        ]);
    ?>
    <?= Accordion::widget([
    		'items' => [
    				[
    					'header' => 'Uczestnicy',
    					'content' => $attendees,
    				],
    				[
    					'header' => 'Płatności',
    					'content' => $payments,
    				]
       		],
    		'options' => ['tag' => 'div', 'class' => 'hidden-lg hidden-md'],
    		'itemOptions' => ['tag' => 'div'],
    		'headerOptions' => ['tag' => 'h3'],
    		'clientOptions' => ['collapsible' => false, 'heightStyle' => 'content'],
    ]) ?>
</div>

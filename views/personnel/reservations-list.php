<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\ButtonDropdown;

$this->title = 'Rezerwacje';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservationsAdmin-list">
	<h1><?= Html::encode($this->title) ?></h1></div>
    
	<br />
    <table class="table table-striped">
    	<tr>
    		<th>#</th>
    		<th>Numer rezerwacji</th>
    		<th>Imię i nazwisko klienta</th>
    		<th>Nazwa oferty</th>
    		<th>Kraj</th>
    		<th>Początek</th>
    		<th>Zakończenie</th>
    		<th>Data rezerwacji</th>
    		<th>Liczba uczestników</th>
    		<th>Wartość rezerwacji</th>
    		<th>&nbsp;</th>
    	</tr>
    	<?php
    		$i = $pagination->page*10 + 1; 
    		foreach ($reservations as $reservation) 
    		{
    			$row = '<tr>';
    			$row .= '<td>' . $i . '</td>';
    			$row .= '<td>' . $reservation->reservationId . '</td>';
    			$row .= '<td>' . $reservation->getCustomers()->one()->customerName . ' ' .
    					$reservation->getCustomers()->one()->customerSurname . '</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerName . '</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->getCountriesCountry()->one()->countryName .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerStartDate .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerEndDate .'</td>';
    			$row .= '<td>' . $reservation->reservationDate .'</td>';
    			$row .= '<td>' . $reservation->getAttendees()->count() . '</td>';
    			$row .= '<td>' . $reservation->reservationPricePerAtendee .',00 zł</td>';
    			$row .= '<td>';
    			
    			echo $row;
    			
    			echo ButtonDropdown::widget([
    					'label' => 'Akcja',
    					'dropdown' => [
    							'items' => [
    									['label' => 'Dodaj płatność', 'url' => '/personnel/addpayement?id=' . $reservation->reservationId],
    									['label' => 'Wystaw fakturę', 'url' => '/personnel/addinvoice?id=' . $reservation->reservationId],
    									['label' => ($reservation->reservationInvoiced != 0 && $reservation->getOffers()->one()->getSettlement()->one() !== null) ? 'Pobierz załącznik' : '',
    											'url' => ($reservation->reservationInvoiced != 0 && $reservation->getOffers()->one()->getSettlement()->one() !== null) ? '/personnel/generate-invoice?invoiceNo=' .
    											$reservation->getCustomerInvoice()->one()->customerInvoiceNo : ''
    									],
    							],
    					],
    					'containerOptions' => [
    							'tag' => 'div',
    							'class' => 'hidden-xs hidden-sm',
    							'style' => 'margin-top: 2px',
    					],
    					'options' =>[
    							'class' => 'btn btn-primary btn-xs'
   					]
    					]); 	
    			$i++;
    			echo '</td></tr>';
    		} 
    	?>
    </table>
 
    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>
<?php



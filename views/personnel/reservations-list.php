<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

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
    		<th>Imię klienta</th>
    		<th>Nazwisko klienta</th>
    		<th>Nazwa oferty</th>
    		<th>Kraj</th>
    		<th>Miejsce pobytu</th>
    		<th>Data rezerwacji</th>
    		<th>Cena</th>
    		<th>Początek</th>
    		<th>Zakończenie</th>
    	</tr>
    	<?php
    		$i = $pagination->page*10 + 1; 
    		foreach ($reservations as $reservation) 
    		{
    			$row = '<tr>';
    			$row .= '<td>' . $i . '</td>';
    			$row .= '<td>' . $reservation->reservationId . '</td>';
    			/*$reservation->getCustomers()->one()->isUser() ?
    			$row .= '<td>' . 'Brak' . '</td>':
    			$row .= '<td>' . $reservation->getCustomers()->one()->getUser()->one()->userLogin . '</td>';*/
    			$row .= '<td>' . $reservation->getCustomers()->one()->customerName . '</td>';
    			$row .= '<td>' . $reservation->getCustomers()->one()->customerSurname . '</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerName . '</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->getCountriesCountry()->one()->countryName .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerAccommodation .'</td>';
    			$row .= '<td>' . $reservation->reservationDate .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerPrice .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerStartDate .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerEndDate .'</td>';
    			$row .= '<td>';
    			/*$row .=  Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'edit?id=' . $reservation->reservationId, [
                    'title' => 'Edytuj']);
    			$row .= '&nbsp;&nbsp;';
    			$row .=  Html::a('<span class="glyphicon glyphicon-trash"></span>', 'delete?id=' . $reservation->reservationId, [
    					'title' => 'Usuń']);*/
    			$row .= '</td></tr>'; 	
    			$i++;
    			echo $row;
    		} 
    	?>
    </table>
 
    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>

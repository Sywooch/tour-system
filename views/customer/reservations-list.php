<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Twoje rezerwacje';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-list">
	<h1><?= Html::encode($this->title) ?></h1></div>
    
	<br />
    <table class="table table-striped">
    	<tr>
    		<th>#</th>
    		<th>Numer rezerwacji</th>
    		<th>Nazwa oferty</th>
    		<th>Kraj</th>
    		<th>Miejsce pobytu</th>
    		<th>Data rezerwacji</th>
    		<th>Cena</th>
    		<th>Początek</th>
    		<th>Zakończenie</th>
    		<th>Wystaw Opinię</th>
    	</tr>
    	<?=Html::a('Aktualizuj', ['update', 'id' => $model->offerId], ['class' => 'btn btn-primary'])?>
    	<?php
    		$i = $pagination->page*10 + 1; 
    		foreach ($reservations as $reservation) 
    		{
    			$row = '<tr>';
    			$row .= '<td>' . $i . '</td>';
    			$row .= '<td>' . $reservation->reservationId . '</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerName . '</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->getCountriesCountry()->one()->countryName .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerAccommodation .'</td>';
    			$row .= '<td>' . $reservation->reservationDate .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerPrice .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerStartDate .'</td>';
    			$row .= '<td>' . $reservation->getOffers()->one()->offerEndDate .'</td>';
    			$row .= '<td>';
    			$row .=  Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/offer/review?id=' . $reservation->reservationId, [
                    'title' => 'Wystaw Opinię']);
    			$row .= '&nbsp;&nbsp;';
    			$row .= '</td></tr>'; 	
    			$i++;
    			echo $row;
    		} 
    	?>
    </table>
 
    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>

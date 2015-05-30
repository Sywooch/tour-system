<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Opinie użytkowników';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-list">
	<h1><?= Html::encode($this->title) ?></h1></div>
    
	<br />
    <table class="table table-striped">
    	<tr>
    		<th>#</th>
    		<th>Użytkownik</th>
    		<th>Data wystawienia opinii</th>
    		<th>Opinia</th>
    		<th>Wziął udział w</th>
    	</tr>
    	<?php
    		$i = $pagination->page*10 + 1; 
    		foreach ($reviews as $review) 
    		{
    			$row = '<tr>';
    			$row .= '<td>' . $i . '</td>';
    			$row .= '<td>' . $review->getReservationsReservation()->one()->getCustomers()->one()->getUser()->one()->userLogin. '</td>';
    			$row .= '<td>' . $review->reviewDate . '</td>';
    			$row .= '<td>' . $review->reviewDescription .'</td>';
    			$row .= '<td>' . $review->getReservationsReservation()->one()->getOffers()->one()->offerName .'</td>';
    			$row .= '<td>';
    			$row .= '</td></tr>'; 	
    			$i++;
    			echo $row;
    		} 
    	?>
    </table>
 
    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>

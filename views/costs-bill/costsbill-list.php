<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Dokumenty kosztowe';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractors-list">
	<h1><?= Html::encode($this->title) ?></h1></div>
    <p>
        <?= Html::a('Dodaj dokument kosztowy', ['add'], ['class' => 'btn btn-success']) ?>
    </p>
	<br />
    <table class="table table-striped">
    	<tr>
    		<th>#</th>
    		<th>Data wystawienia</th>
    		<th>Numer dokumentu</th>
    		<th>Opis zdarzenia</th>
    		<th>Wartość brutto</th>
    		<th>Nazwa skrócona kontrahenta</th>
    		<th>Dotyczy oferty</th>
    		<th>Akcje</th>
    	</tr>
    	<?php
    		$i = $pagination->page*10 + 1; 
    		foreach ($costsBills as $costBill) 
    		{
    			$row = '<tr>';
    			$row .= '<td>' . $i . '</td>';
    			$row .= '<td>' . $costBill->costsBillDate . '</td>';
    			$row .= '<td>' . $costBill->costsBillNo . '</td>';
    			$row .= '<td>' . $costBill->costsBillDescription .'</td>';
    			$row .= '<td>' . $costBill->costsBillValue .'</td>';
    			$row .= '<td>' . $costBill->getContractor()->one()->contractorShortName .'</td>';
    			$row .= '<td>' . $costBill->getSettlement()->one()->getOffer()->one()->offerName .'</td>';
    			$row .= '<td>';
    			$row .=  Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'edit?id=' . $costBill->costsBillId, [
                    'title' => 'Edytuj']);
    			$row .= '&nbsp;&nbsp;';
    			$row .=  Html::a('<span class="glyphicon glyphicon-trash"></span>', 'delete?id=' . $costBill->costsBillId, [
    					'title' => 'Usuń']);
    			$row .= '</td></tr>'; 	
    			$i++;
    			echo $row;
    		} 
    	?>
    </table>
 
    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>

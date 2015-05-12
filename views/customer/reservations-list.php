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
    		<th>Data rezerwacji</th>
    		<th>Nazwa Pełna</th>
    		<th>Kraj</th>
    		<th>Numer NIP</th>
    		<th>Akcje</th>
    	</tr>
    	<?php
    		$i = $pagination->page*10 + 1; 
    		foreach ($reservations as $reservation) 
    		{
    			$row = '<tr>';
    			$row .= '<td>' . $i . '</td>';
    			$row .= '<td>' . $contractor->contractorShortName . '</td>';
    			$row .= '<td>' . $contractor->contractorFullName . '</td>';
    			$row .= '<td>' . $contractor->contractorCountry .'</td>';
    			$row .= '<td>' . $contractor->contractorNIP .'</td>';
    			$row .= '<td>';
    			$row .=  Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'edit?id=' . $contractor->contractorId, [
                    'title' => 'Edytuj']);
    			$row .= '&nbsp;&nbsp;';
    			$row .=  Html::a('<span class="glyphicon glyphicon-trash"></span>', 'delete?id=' . $contractor->contractorId, [
    					'title' => 'Usuń']);
    			$row .= '</td></tr>'; 	
    			$i++;
    			echo $row;
    		} 
    	?>
    </table>
 
    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>

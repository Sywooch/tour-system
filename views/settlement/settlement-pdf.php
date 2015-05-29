<?php
use yii\helpers\Html;
use app\models\Reservation;

/* @var $this y. ii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

?>
<div class="pdf">
    <h1 class="text-center">Rozliczenie imprezy nr: <?= $settlement->settlementNo ?></h1>
    <div class="row">
    	<strong>Nazwa imprezy: </strong> <?=  $settlement->getOffer()->one()->offerName ?><br><br>
    	<strong>Termin wyjazdu: </strong> <?=  $settlement->getOffer()->one()->offerStartDate ?> - <?=  $settlement->getOffer()->one()->offerEndDate ?><br><br>
    	<?php
    		$attendiesNo = 0;
    		$Reservations = $settlement->getOffer()->one()->getReservations()->all();
    		foreach($Reservations as $Reservation)
    			$attendiesNo += $Reservation->getAttendies()->count(); 
    	?>
    	<strong>Liczba uczestników: </strong> <?=  $attendiesNo ?><br><br>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
		    <table class="table table-bordered">
		    	<tr>
		    		<th>Data wystawienia dokumentu</th>
		    		<th>Numer dokumentu</th>
		    		<th>Kontrahent</th>
		    		<th>Opis zdarzenia</th>
		    		<th>Wartość brutto</th>
		    	</tr>
				<?php 
					foreach($costsBills as $costBill){
						$row = <<<ROW
				<tr>
					<td class="text-center">{$costBill->costsBillDate}</td>
					<td class="text-center">{$costBill->costsBillNo}</td>
					<td>{$costBill->getContractor()->one()->contractorFullName}, {$costBill->getContractor()->one()->contractorStreet}, 
					{$costBill->getContractor()->one()->contractorPostcode} {$costBill->getContractor()->one()->contractorCity}, 
					NIP: {$costBill->getContractor()->one()->contractorNIP}</td>
					<td>{$costBill->costsBillDescription}</td>
					<td class="text-right">{$costBill->costsBillValue} zł</td>
				</tr>
ROW;
					echo $row;
					}
				?>
		    </table>
		</div>
		<br>
		<div class="col-lg-12">
			<strong>Przychód razem: </strong> <?=  $settlement->settlementTotalIncome ?> zł<br><br>
			<strong>Koszty razem: </strong> <?=  $settlement->settlementCosts ?> zł<br><br>
			<strong>Marża brutto: </strong> <?=  $settlement->getMargin() ?> zł<br><br>
			<?php 
				if($attendiesNo != 0){
					$attendeeCosts = $settlement->settlementCosts / $attendiesNo;
					$attendeeMargin = $settlement->getMargin() / $attendiesNo;
				}else{
					$attendeeCosts = '-';
					$attendeeMargin = '-';
				}
			?>
			<strong>Koszty na 1 uczestnika: </strong> <?=  $attendeeCosts ?> zł<br><br>
			<strong>Marża na 1 uczestnika: </strong> <?=  $attendeeMargin ?> zł<br><br><br>
			<strong>Sporządzono dnia: </strong> <?=  $settlement->settlementDate ?><br>
		</div>
    </div>
</div>

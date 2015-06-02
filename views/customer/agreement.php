<?php
?>
<h1 style="text-align: center">Umowa</h1>
<br>
<p style="text-align: justify;">zawarta w dniu <?= $reservation->reservationDate ?> pomiędzy:<br>
<?= $config->companyName ?>, <?= $config->companyAddress ?>, <?= $config->companyPostcode ?> 
<?= $config->companyCity ?>, NIP: <?= $config->companyNIP ?> reprezentowanym przez ..........................., zwanym dalej
<b>Biurem podróży</b>, a:<br>
<?= $reservation->getCustomers()->one()->customerName ?> <?= $reservation->getCustomers()->one()->customerSurname ?>,
<?= $reservation->getCustomers()->one()->customerStreet ?>, <?= $reservation->getCustomers()->one()->customerPostcode ?> 
<?= $reservation->getCustomers()->one()->customerCity ?>, PESEL: <?= $reservation->getCustomers()->one()->customerPESEL ?>,
zwanym(ą) dalej <b>Klientem</b>.</p>
<br>
<span  style="text-align: center">&sect; 1</span>
 <p style="text-align: justify;"><b>Klient</b> zawiera umowę z <b>Biurem podróży</b>, która obejmuje uczestnictwo w imprezie 
 turystycznej o nazwie <?= $reservation->getOffers()->one()->offerName ?> w terminie <?= $reservation->getOffers()->one()->offerStartDate ?>-
 <?= $reservation->getOffers()->one()->offerEndDate ?>, zgodnie z ofertą stanowiącą załącznik do niniejszej umowy, uczestników 
 wymienionyn w &sect; 2 niniejszej umowy.</p>
 <span  style="text-align: center">&sect; 2</span>
 <p style="text-align: justify;"><b>Biuro podróży</b> zobowiązuje się do zrealizowania programu oferty stanąwiącej załącznik do
 niniejszej umowy, dla uczestników w imieniu których <b>Klient</b> zawarł umowę:</p>
 <ol>
 <?php
 	foreach($reservation->getAttendees()->all() as $attendee){
 		$at = <<<ATTENDEE
 	<li>
		Imię i nazwisko: {$attendee->attendeeName} {$attendee->attendeeSurname}<br>
		Adres zameldowania: {$attendee->attendeeStreet}, {$attendee->attendeeSPostcode} {$attendee->attendeeCity}<br>
		PESEL: {$attendee->attendeePESEL}
 	</li>
ATTENDEE;
 		echo $at;
 	}
 ?>
 </ol> 
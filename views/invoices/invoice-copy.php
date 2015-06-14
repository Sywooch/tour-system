<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>
<hgroup style="text-align:right;">
<h2 style="margin: none; padding none;">Procedura VAT-Marża dla biur podróży nr: <?php echo $invoice->customerInvoiceNo; ?></h2>
<h4 style="margin: none; padding none;"><u>ZAŁĄCZNIK</u></h4>
<h4 style="margin: none; padding none;">Data wystawienia: <?php echo $settlement->settlementDate; ?></h4>
</hgroup>

<br><br>
<table width="100%">
<tr>
<td width="40%" style="border: 1px solid black">
<h4>Sprzedawca</h4>
<?php echo $conf->companyName; ?><br>
<?php echo $conf->companyAddress; ?><br>
<?php echo $conf->companyPostcode; ?> <?php echo $conf->companyCity; ?><br>
NIP: <?php echo $conf->companyNIP; ?>
</td>
<td width="20%" style="border-top: none !important; border-bottom: none !important;">&nbsp;</td>
<td width="40%" style="border: 1px solid black">
<h4>Nabywca</h4>
<?php echo $reservation->getCustomers()->one()->customerName . " "; ?>
<?php echo $reservation->getCustomers()->one()->customerSurname; ?><br>
<?php echo $reservation->getCustomers()->one()->customerStreet; ?><br>
<?php echo $reservation->getCustomers()->one()->customerPostcode; ?> <?php echo $reservation->getCustomers()->one()->customerCity; ?><br>
</td></tr>
</table>
<br><br>
<br>
Data sprzedarzy: <?php echo $invoice->customerInvoiceDateOfSale; ?> <br>
Metoda płatności: <?php echo $payment_method->paymentMethodName;?> <br>
Termin płatności: <?php echo $invoice->customerInvoicePaymentDate; ?> 
<br><br>
<table  width="100% style="border: 1px solid black"">
<tr>
	<th width="5%" style="border: 1px solid black">L.p</th>
	<th width="65%" style="border: 1px solid black">Za co</th>
	<th width="10%" style="border: 1px solid black">Cena zakupu</th>
	<th width="10%" style="border: 1px solid black">Marża brutto</th>
	<th width="10%" style="border: 1px solid black">Cena sprzedaży</th>
</tr>
<tr>
<?php

			$attendeesQty = $reservation->getOffers()->one()->countAttendees();
			$attendeesQty = $reservation->getAttendees()->count();
			$costs = round(($settlement->settlementCosts / $attendeesQty),2);
			$margin = round((($settlement->settlementTotalIncome - $settlement->settlementCosts) / $attendeesQty),2);
			$price = round(($reservation->reservationPricePerAtendee / $attendeesQty),2);
    		$i=1;
    		foreach ($reservation->getAttendees()->all() as $attendee) 
    		{
    			$row = '<tr>';
    			$row .= '<td width="5%" style="border: 1px solid black">' . $i . '</td>';
    			$row .= '<td width="65%" style="border: 1px solid black">' . 'Udział w imprezie turystycznej: ' . $reservation->getOffers()->one()->offerName . '<br>';
    			$row .= 'w terminie od' . $reservation->getOffers()->one()->offerStartDate . ' do ' . $reservation->getOffers()->one()->offerEndDate . '<br>';     			
    			$row .= 'Imię i nazwisko uczestnika: ' . $attendee->attendeeName . ' '. $attendee->attendeeSurname . '</td>';
    			$row .= '<td width="10%" style="text-align: right; border: 1px solid black">' . $costs .' zł</td>';
    			$row .= '<td width="10%" style="text-align: right; border: 1px solid black">' . $margin .' zł</td>';
    			$row .= '<td width="10%" style="text-align: right; border: 1px solid black">' . $price .',00 zł</td>';
    			$row .= '</tr>'; 	
    			$i++;
    			echo $row;
    		} 
    	?>
</tr>
</table>
<br><br>
<table width="40%">
	<tr>
		<th width="10%" style="border: 1px solid black">Stawka VAT</th>
		<th width="10%" style="border: 1px solid black">Wartość netto</th>
		<th width="10%" style="border: 1px solid black">Podatek VAT</th>
		<th width="10%" style="border: 1px solid black">Wartość brutto</th>
	</tr>
	<tr>
		<td width="10%" style="border: 1px solid black">23%</td>
		<td width="10%" style="border: 1px solid black"><?= round((($margin * $attendeesQty) / 1.23),2) ?> zł</td>
		<td width="10%" style="border: 1px solid black"><?= round((($margin * $attendeesQty * 0.23) / 1.23),2) ?> zł</td>
		<td width="10%" style="border: 1px solid black"><?= round(($margin * $attendeesQty),2) ?> zł</td>
	</tr>  
</table>
<?php $total =  $reservation->reservationPricePerAtendee . ',00'?>
<br><br>
<h4>Razem: <?php echo $total; ?> zł</h2>
<p>Słownie: <?php echo $invoice->kwotaslownie($total); ?>
<br>
<br>
<br>
<br>
<br>
<h4>Zapłacono: <?php echo $reservation->getPaymentsValue(); ?>,00 zł</h2>
<h4>Pozostaje do zapłaty: <?php echo $reservation->reservationPricePerAtendee-$reservation->getPaymentsValue(); ?>,00 zł</h2> <br>

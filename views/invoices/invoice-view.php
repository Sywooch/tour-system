<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<div class="row">
<div class="text-right">
<h2>Procedura VAT-Marża dla biur podróży nr: <?php echo $invoice->customerInvoiceNo; ?></h2>
<h4>Data wystawienia: <?php echo $invoice->customerInvoiceDate; ?></h4>
</div>
</div>
<br><br>
<div class="row">
<table class="col-xs-12">
<tr width="40%" style="border: 1px solid black">
<td  width="40%" style="border: 1px solid black">
<h4>Sprzedawca</h4>
<?php echo $conf->companyName; ?><br>
<?php echo $conf->companyAddress; ?><br>
<?php echo $conf->companyPostcode; ?> <?php echo $conf->companyCity; ?><br>
NIP: <?php echo $conf->companyNIP; ?>
</td>
<td width="20%" style="border-top: none; border-bottom:none">&nbsp;</td>
<td  width="40%" style="border: 1px solid black">
<h4>Nabywca</h4>
<?php echo $reservation->getCustomers()->one()->customerName . " "; ?>
<?php echo $reservation->getCustomers()->one()->customerSurname; ?><br>
<?php echo $reservation->getCustomers()->one()->customerStreet; ?><br>
<?php echo $reservation->getCustomers()->one()->customerPostcode; ?> <?php echo $reservation->getCustomers()->one()->customerCity; ?><br>
</td></tr>
</table>
</div>

<div class="row">
<br>
Data sprzedarzy: <?php echo $invoice->customerInvoiceDateOfSale; ?> <br>
Metoda płatności: <?php echo $payment_method->paymentMethodName;?> <br>
Termin płatności: <?php echo $invoice->customerInvoicePaymentDate; ?> 
</div>
<br>
<div class="row">
<table class="table table-bordered">
<tr>
	<th>L.p</th>
	<th>Za co</th>
	<th>Cena sprzedaży</th>
</tr>
<tr>
<?php
    		$i=1;
    		foreach ($attendees as $attendee) 
    		{
    			$row = '<tr>';
    			$row .= '<td>' . $i . '</td>';
    			$row .= '<td>' . 'Udział w imprezie: ' . $reservation->getOffers()->one()->offerName . '<br>';      			
    			$row .= 'Imię i nazwisko uszestnika: ' . $attendee->attendeeName . ' '. $attendee->attendeeSurname . '</td>';
    			$row .= '<td class="pull-right">' . $reservation->reservationPricePerAtendee .',00 zł</td>';
    			$row .= '</tr>'; 	
    			$i++;
    			echo $row;
    		} 
    	?>
</tr>
</table>
</div>

<div class="row">
<br>
<h2>Razem: <?php echo $reservation->reservationPricePerAtendee*($i-1); ?></h2>
</div>

<div class="row">
<br>
<h2>Zapłacono: <?php echo $reservation->getPaymentsValue(); ?>,00 zł</h2>
<h2>Pozostaje do zapłaty: <?php echo $reservation->reservationPricePerAtendee*($i-1)-$reservation->getPaymentsValue(); ?>,00 zł</h2> <br>
</div>
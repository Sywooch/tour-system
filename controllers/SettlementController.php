<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Settlement;
use app\models\Reservation;
use app\models\CostsBill;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class SettlementController extends Controller
{
	public $layout = 'AdminPanel';
	
	public function actionAdd($id)	
    {
    	$settlement = new Settlement();
    	$costsBill = new CostsBill();
    	
    	if(isset($_POST['Settlement']) && isset($_POST['costBillDate'])){
    		$reservations = Reservation::find()->where('=', 'offers_offerId', $id);
    		$totalIncome = 0;
    		$totalCosts = 0;
    		foreach($reservations as $reservation)
    			$totalIncome += $reservation->reservationPrice;
    		foreach($_POST['costBillValue'] as $costValue)
    			$totalCosts += $costValue;
    		$totalVAT = ($totalIncome - $totalCosts) * 0.23 / 1.23;
    		
    		$settlement->offers_offerId = $id;
    		$settlement->settlementNo = $_POST['Settlement']['SettlementNo'];
    		$settlement->settlementDate = $_POST['Settlement']['SettlementDate'];
    		
    		$settlement->save();
    	}
    	
    	return $this->render('settlement-form', ['settlement' => $settlement, 'costsBill' => $costsBill]);
    }
 }
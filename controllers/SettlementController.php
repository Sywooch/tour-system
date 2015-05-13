<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Settlement;
use app\models\Offer;
use app\models\CostsBill;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use app\models\app\models;

class SettlementController extends Controller
{
	public $layout = 'AdminPanel';
	
	public function actionAdd($id)	
    {
    	$settlement = new Settlement();
    	$costsBill = new CostsBill();
    	
    	if (Yii::$app->request->isAjax && $settlement->load(Yii::$app->request->post())) {
    		Yii::$app->response->format = Response::FORMAT_JSON;
    		return ActiveForm::validate($settlement);
    	}
    	
    	if (Yii::$app->request->isAjax && $costsBill->load(Yii::$app->request->post())) {
    		Yii::$app->response->format = Response::FORMAT_JSON;
    		return ActiveForm::validate($costsBill);
    	}
    	
    	if($settlement->load(Yii::$app->request->post())){
    		/*$offer = Offer::find($id)->one();
    		$settlement->settlementTotalIncome = 0;
    		$settlement->settlementCosts = 0;
    		$reservations = $offer->getReservations()->all();
    		foreach($reservations as $reservation) 
    			$settlement->settlementTotalIncome += $reservation->reservationPricePerAtendee;
    		foreach($_POST['CostsBill'] as $cb)
    			$settlement->settlementCosts += $cb['costsBillValue'];
    		$settlement->settlementVAT = ($settlement->settlementTotalIncome - $settlement->settlementCosts) * 0.23 / 1.23;
    		$settlement->offers_offerId = $id;
    		$settlement->settlementNo = $_POST['Settlement']['settlementNo'];
    		$settlement->settlementDate = $_POST['Settlement']['settlementDate'];
    		
    		$settlement->save();
    		
    		foreach($_POST['CostsBill'] as $cb){
    			$costBill = new CostsBill();
    			$costBill->settlements_offerId = $settlement['offers_offerId'];
    			$costBill->costsBillDate = $cb['costsBillDate'];
    			$costBill->costsBillNo = $cb['costsBillNo'];
    			$costBill->costsBillValue = $cb['costsBillValue'];
    			$costBill->costsBillDescription = $cb['costsBillDescription'];
    			$costBill->contractors_contractorId = $cb['contractors_contractorId'];
    			$costBill->save(); */
    		var_dump($_POST);
    	}
    	
    	return $this->render('settlement-form', ['settlement' => $settlement, 'costsBill' => $costsBill]);
    }
 }
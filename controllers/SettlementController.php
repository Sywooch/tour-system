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

class SettlementController extends Controller
{
	public $layout = 'AdminPanel';
	
	public function actionAdd($id)	
    {
    	$settlement = Settlement::find($id)->one();
    	
    	$costsBills = CostsBill::find()
    	->where(['settlements_offerId' => $id])
    	->all();
    	
    	if($settlement === null){
    		$settlement = new Settlement();
    		
    		$settlement->offers_offerId = $id;
    		
    		$settlement->settlementCosts = 0;
    		foreach($costsBills as $costBill){
    			$settlement->settlementCosts += $costBill->costsBillValue;
    		}
    		 
    		$settlement->settlementTotalIncome = Offer::find($id)->one()->getTotalIncome();
    		$settlement->settlementVAT = ($settlement->settlementTotalIncome - $settlement->settlementCosts) * 0.23 / 1.23;
    		if($settlement->settlementVAT < 0) $settlement->settlementVAT = 0;
    	}
    	
    	if (Yii::$app->request->isAjax && $settlement->load(Yii::$app->request->post())) {
    		Yii::$app->response->format = Response::FORMAT_JSON;
    		return ActiveForm::validate($settlement);
    	}
    	
    	if ($settlement->load(Yii::$app->request->post())) {
    		
    		Yii::$app->session->setFlash('settlementAdded');
    		
			if($settlement->save(false))
    			return $this->refresh();
			else{
				Yii::$app->session->setFlash('settlementError');
				return $this->refresh();
			}
    	}
    	
    	return $this->render('settlement-form', ['settlement' => $settlement, 'costsBills' => $costsBills]);
    }
 }
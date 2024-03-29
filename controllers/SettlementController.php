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
    	$settlement = Settlement::find()->where(['offers_offerId'=> $id])->one();
    	
    	$costsBills = CostsBill::find()
    	->where(['offers_offerId' => $id])
    	->all();
    	
    	if($settlement === null){
    		$settlement = new Settlement();
    		
    		$settlement->offers_offerId = $id;
    		
    		$settlement->settlementCosts = 0;
    		foreach($costsBills as $costBill){
    			$settlement->settlementCosts += $costBill->costsBillValue;
    		}
    		 
    		$settlement->settlementTotalIncome = Offer::find($id)->one()->getTotalIncome();
    		$settlement->settlementVAT = round((($settlement->settlementTotalIncome - $settlement->settlementCosts) * 0.23 / 1.23),2);
    		if($settlement->settlementVAT < 0) $settlement->settlementVAT = 0;
    	}
    	
    	if (Yii::$app->request->isAjax && $settlement->load(Yii::$app->request->post())) {
    		Yii::$app->response->format = Response::FORMAT_JSON;
    		return ActiveForm::validate($settlement);
    	}
    	

    	if ($settlement->load(Yii::$app->request->post()) && $settlement->save(false)) {
    		Yii::$app->session->setFlash('settlementAdded');	
    		return $this->refresh();
    	}
    	
    	$settlement->settlementCosts = 0;
    	foreach($costsBills as $costBill){
    		$settlement->settlementCosts += $costBill->costsBillValue;
    	}
    	 
    	$settlement->settlementTotalIncome = Offer::find($id)->one()->getTotalIncome();
    	$settlement->settlementVAT = round((($settlement->settlementTotalIncome - $settlement->settlementCosts) * 0.23 / 1.23),2);
    	if($settlement->settlementVAT < 0) $settlement->settlementVAT = 0;
    	
    	return $this->render('settlement-form', ['settlement' => $settlement, 'costsBills' => $costsBills]);
    }
    
    public function actionReport($id) {
    	
    	$settlement = Settlement::find()->where(['offers_offerId'=> $id])->one();
    	$costsBills = CostsBill::find()
    	->where(['offers_offerId' => $id])
    	->all();
    
    	$content = $this->renderPartial('settlement-pdf', ['settlement' => $settlement, 'costsBills' => $costsBills]);
    	$pdf = Yii::$app->pdf; // or new Pdf();
    	$mpdf = $pdf->api; // fetches mpdf api
    	$mpdf->SetHeader('TourSystem'); // call methods or set any properties
    	$css = file_get_contents(Yii::$app->basePath . "/vendor/bower/bootstrap/dist/css/bootstrap.min.css");
    	$mpdf->WriteHtml($css, 1);
    	$mpdf->WriteHtml($content, 2); // call mpdf write html
    	echo $mpdf->Output('settlement.pdf', 'D'); // call the mpdf api output as needed
    }
 }
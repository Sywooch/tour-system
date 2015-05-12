<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Customer;
use app\models\Reservation;
use app\models\Attendee;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use app\models\app\models;

class CustomerController extends Controller
{
	public $layout = 'StartingPanel';

	public function actionAdd()
	{
		$model1 = new User ();
		$model2 = new Customer();
		
		$model1->groups_groupId=3;
		//$model1->generateAuthKey();
		$model1->authKey = "hgytdydrdrdyrdrt";
		 
		if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model1);
			return ActiveForm::validate($model2);
		}
		 
		if (($model1->load(Yii::$app->request->post()) && $model1->save()) && ($model2->load(Yii::$app->request->post()) && $model2->save())) {
			$model2->user_userId=$model1->getId();
			$model1->setPassword($model1->userPassword);
			
			$model1->save(); $model2->save();
			
			Yii::$app->session->setFlash('customerAdded');
			return $this->refresh();
		} else {
			return $this->render('customer-form', array ('model1' => $model1, 'model2' => $model2));
		}
	}

	
public function actionBuy($id)
	{
		$model1 = new Reservation ();
		$model2 = new Attendee();
		
		if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isCustomer())
		{
			
			
			if ($model2->load(Yii::$app->request->post())) {
				print_r($model2);
				$model1->reservationDate=date('Y-m-d');
				$model1->offers_offerId = $id;
				$offer = Offer::findOne($id);
				$model1->reservationPricePerAtendee = $offer->offerPrice;
				//if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAgent())
				//	$model1->agents_userId=getAgents()->agentId;
				//else 
				$model1->customers_userId=Yii::$app->User->identity->getCustomer();
				$model1->save();
				$model2->reservations_reservationId=$model1->reservationId; 
				$model2->save();
			
				Yii::$app->session->setFlash('reservationAdded');
				return $this->refresh();
			} else {
				return $this->render('/reservations/reservation-form', ['model2' => $model2]);
			}
		}
	}
	public function actionEdit($id){
	
			$model1 = User::findIdentity($id);
			$model2 = $model1->getCustomer();//Customer::findOne($cid);
	
			if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($model1);
				return ActiveForm::validate($model2);
			}
	
			if (($model1->load(Yii::$app->request->post()) && $model1->save()) && ($model2->load(Yii::$app->request->post()) && $model2->save())) {
				Yii::$app->session->setFlash('customerEdited');
				return $this->refresh();
			} else {
				return $this->render('customer-form', array ('model1' => $model1, 'model2' => $model2));
			}
	}

}

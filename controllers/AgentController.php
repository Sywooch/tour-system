<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Agent;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class AgentController extends Controller
{
	public $layout = 'AdminPanel';

	public function actionAdd()
	{
		$model1 = new User ();
		$model2 = new Agent();
		
		$model1->groups_groupId=2;
		
		 
		if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model1);
			return ActiveForm::validate($model2);
		}
		 
		if (($model1->load(Yii::$app->request->post()) && $model1->save()) && ($model2->load(Yii::$app->request->post()) && $model2->save())) {
			$model2->user_userId=$model1->getId();
			$model1->setPassword($model1->userPassword);
			$model1->generateAuthKey();
			$model1->save(); $model2->save();
			Yii::$app->session->setFlash('agentAdded');
			return $this->refresh();
		} else {
			return $this->render('agent-form', array ('model1' => $model1, 'model2' => $model2));
		}
	}


public function actionBuy($id)
	{
		$model1 = new Reservation ();
		$model2 = new Attendee();
		$model3 = new ReservationForm();
		
		if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAgent())
		{
			if (Yii::$app->request->isAjax && $model2->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($model2);
			}	
			
			if ($model2->load(Yii::$app->request->post()) || $model3->load(Yii::$app->request->post())) {
				$model1->reservationDate=date('Y-m-d');
				$model1->offers_offerId = $id;
				$offer = Offer::findOne($id);
				$model1->reservationPricePerAtendee = $offer->offerPrice*$model3->attendeeQuantity;
				$model1->customers_userId=Yii::$app->User->identity->getCustomer()->one()->user_userId;
				$model1->save();
				$model2->reservations_reservationId=$model1->reservationId;
				$model2->save();
				
				Yii::$app->session->setFlash('reservationAdded');
				return $this->refresh();
			} else {
				return $this->render('/reservations/reservation-form', array ('model2' => $model2, 'model3' => $model3));
			}
		}
	}

	public $layout = 'AgentPanel';
	
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}
		if (Yii::$app->user->identity->isAgent ()) {
			$this->layout = 'AgentPanel';
		} else {
			if (Yii::$app->user->identity->isCustomer ()) {
				$this->layout = 'StartingPanel';
			} else {
				$this->layout = 'AdminPanel';
			}
		}
			
		return true; // or false to not run the action
	}

	public function actionAdd()
	{
		$model1 = new User ();
		$model2 = new Agent();
		
		$model1->groups_groupId=2;
		
		 
		if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model1);
			return ActiveForm::validate($model2);
		}
		 
		if (($model1->load(Yii::$app->request->post()) && $model1->save()) && ($model2->load(Yii::$app->request->post()) && $model2->save())) {
			$model2->user_userId=$model1->getId();
			$model1->setPassword($model1->userPassword);
			$model1->generateAuthKey();
			$model1->save(); $model2->save();
			Yii::$app->session->setFlash('agentAdded');
			return $this->refresh();
		} else {
			return $this->render('agent-form', array ('model1' => $model1, 'model2' => $model2));
		}
	}

}

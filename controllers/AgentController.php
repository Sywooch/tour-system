<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Agent;
use app\models\ModelExtended;
use app\models\Reservation;
use app\models\Attendee;
use app\models\Offer;
use app\models\ReservationForm;
use app\models\Customer;
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
		$model1->authKey = "hgytdydrdrdyrdrt";
		 
		if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model1);
			return ActiveForm::validate($model2);
		}
		 
		if (($model1->load(Yii::$app->request->post()) && $model1->save()) && ($model2->load(Yii::$app->request->post()) && $model2->save())) {
			$model2->user_userId=$model1->getId();
			$model1->setPassword($model1->userPassword);
			//$model1->generateAuthKey();
			$model1->save(); $model2->save();
			Yii::$app->session->setFlash('agentAdded');
			return $this->refresh();
		} else {
			return $this->render('agent-form', array ('model1' => $model1, 'model2' => $model2));
		}
	}



	public function actionSell($id)
	{
	
		if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAgent())
		{
			$attendees = [new Attendee()];
			$customer = new Customer();
			$reservation = new Reservation();	
			
			if (Yii::$app->request->isPost) {
				$customer->load(Yii::$app->request->post());
				$reservation->load(Yii::$app->request->post());
				$attendees = ModelExtended::createMultiple(Attendee::classname());
				ModelExtended::loadMultiple($attendees, Yii::$app->request->post());
				
			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($attendees),
                    ActiveForm::validate($customer),
                	ActiveForm::validate($reservation)
                );
            }
					
				// validate all models
				//$valid = $reservationForm->validate();
				$valid = ModelExtended::validateMultiple($attendees);
				$valid = ActiveForm::validate($reservation) && $valid;
				$valid = ActiveForm::validate($customer) && $valid;
					
				if ($valid) {
					/*$transaction = \Yii::$app->db->beginTransaction();
					try {
						if($flag = $customer->save(false)){ */
							$reservation->reservationDate = date("Y-m-d");
							$reservation->reservationInvoiced = false;
							$reservation->agents_userId=Yii::$app->User->identity->getAgent()->one()->user_userId;
			//				$reservation->customers_userId = $customer->customerId;
							$count = 0;
							foreach($attendees as $attende) $count++;
							$reservation->reservationPricePerAtendee = $count * Offer::findOne($id)->offerPrice;
							$reservation->offers_offerId = $id;
		/*
							if ($flag = $reservation->save(false)) {
								foreach ($attendees as $attendee) {
									$attendee->reservations_reservationId = $reservation->reservationId;
		
									if (! ($flag = $attendee->save(false))) {
										$transaction->rollBack();
										Yii::$app->session->setFlash('attendeesError');
										break;
									}
								}
							}
							if ($flag) {
								$transaction->commit();
								Yii::$app->session->setFlash('reservationSold');
							}
						}
					} catch (Exception $e) {
						$transaction->rollBack();
						Yii::$app->session->setFlash('reservationNotSold');
					}*/
				} 
					return $this->render('/reservations/test', ['m1' => $customer, 'm2' => $reservation, 'm3' => $attendees]);
			}
				
			$offerName = Offer::findOne($id)->offerName;
				
			return $this->render('/reservations/reservation-formagent', [
					//'reservationForm' => $reservationForm,
					'offerName' => $offerName,
					'offerId' => $id,
					'reservation' => $reservation,
					'attendees' => (empty($attendees)) ? [new Attendee] : $attendees,
					'customer' => $customer
			]);
				
		}
	}
	
public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}
		if (Yii::$app->user->isGuest) {
			$this->layout = 'StartingPanel';
		} else {
			if (Yii::$app->user->identity->isAgent ()) {
				$this->layout = 'AgentPanel';
			} else {
				if (Yii::$app->user->identity->isCustomer ()) {
					$this->layout = 'StartingPanel';
				} else {
					$this->layout = 'AdminPanel';
				}
			}
		}
			
		return true; // or false to not run the action
	}

	public function actionSold()
	{
		$query1 = Reservation::find()->where (['agents_userId' => Yii::$app->user->identity->getAgent()->one()->agentId]);
		
		$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query1->count(),
		]);
		
		$reservations = $query1->orderBy('ReservationId')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		
		return $this->render('/personnel/reservations-list', [
				'reservations' => $reservations,
				'pagination' => $pagination,
		]);
	}
	
	
}

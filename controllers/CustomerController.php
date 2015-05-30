<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Customer;
use app\models\Reservation;
use app\models\ReservationForm;
use app\models\Attendee;
use app\models\Offer;
use app\models\Modelforattendees;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use app\models\ModelExtended;



class CustomerController extends Controller
{
	public $layout = 'StartingPanel';

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
				
		if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isCustomer())
		{
			$attendees = [new Attendee()];
			$reservationForm = new ReservationForm();
			
			if ($reservationForm->load(Yii::$app->request->post())) {
				$attendees = ModelExtended::createMultiple(Attendee::classname());
				ModelExtended::loadMultiple($attendees, Yii::$app->request->post());
				// ajax validation
				if (Yii::$app->request->isAjax) {
					Yii::$app->response->format = Response::FORMAT_JSON;
					return ArrayHelper::merge(
							ActiveForm::validateMultiple($attendees),
							ActiveForm::validate($reservationForm)
					);
				}
					
				// validate all models
				$valid = $reservationForm->validate();
				$valid = ModelExtended::validateMultiple($attendees) && $valid;
					
				if ($valid) {
					$reservation = new Reservation();
					$reservation->reservationDate = date("Y-m-d");
					$reservation->reservationInvoiced = false;
					$reservation->customers_userId = Yii::$app->user->identity->getCustomer()->one()->customerId;
					if($reservationForm->userAttends === true) $count = 1;
					else $count = 0;
					foreach($attendees as $attende) $count++;
					$reservation->reservationPricePerAtendee = $count * Offer::findOne($id)->offerPrice;
					$reservation->offers_offerId = $id;
				
					$transaction = \Yii::$app->db->beginTransaction();
					try {
						if ($flag = $reservation->save(false)) {
							if($reservationForm->userAttends == '1'){
								$user = new Attendee();
								$user->attendeeName = $app->user->identity->getCustomer()->one()->customerName;
								$user->attendeeSurname = $app->user->identity->getCustomer()->one()->customerSurname;
								$user->attendeeStreet = $app->user->identity->getCustomer()->one()->customerStreet;
								$user->attendeeSPostcode = $app->user->identity->getCustomer()->one()->customerPostcode;
								$user->attendeeCity = $app->user->identity->getCustomer()->one()->customerCity;
								$user->attendeePESEL = $app->user->identity->getCustomer()->one()->customerPESEL;
								$user->attendeeBirthdate = $app->user->identity->getCustomer()->one()->customerBirthdate;
								$user->reservations_reservationId = $reservation->reservationId;
				
								if (! ($flag = $user->save(false))) {
									$transaction->rollBack();
									Yii::$app->session->setFlash('customerAsAttendeeError');
								}
							}
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
							Yii::$app->session->setFlash('reservationAdded');
						}
					} catch (Exception $e) {
						$transaction->rollBack();
						Yii::$app->session->setFlash('reservationNotAdded');
					}
				}
			}
			
			return $this->render('/reservations/reservation-form', [
					'reservationForm' => $reservationForm,
					'attendees' => (empty($attendees)) ? [new Attendee] : $attendees
			]);
			
		}	
	}
public function actionEdit($id){
	
			$model1 = User::findIdentity($id);
			$model1->userPassword=NULL;
			$model2 = $model1->getCustomer()->one();
	
			if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($model1);
				return ActiveForm::validate($model2);
			}
	
			if (($model1->load(Yii::$app->request->post()) && $model1->save()) && ($model2->load(Yii::$app->request->post()) && $model2->save())) {
				$model1->setPassword($model1->userPassword);	
				$model1->save();
				Yii::$app->session->setFlash('customerEdited');
				return $this->refresh();
			} else {
				return $this->render('customer-form', array ('model1' => $model1, 'model2' => $model2));
			}
	}
	
	public function actionReservations () {
		$query1 = Reservation::find()->where(['customers_userId' => Yii::$app->user->identity->getCustomer()->one()->customerId]);
		//$query2 = Offer::find()->where (['']);
		//$query2 = $query1->getOffers()->all();
		
		$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query1->count(),
		]);
		
		$reservations = $query1->orderBy('ReservationId')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		
		//$offers = $query2->orderBy('')
		
		return $this->render('reservations-list', [
				'reservations' => $reservations,
				'pagination' => $pagination,
		]);		
	}
	
	public function actionAgreement() {
	
		$content = $this->renderPartial('render-form');
		$pdf = Yii::$app->pdf; // or new Pdf();
		$mpdf = $pdf->api; // fetches mpdf api
		$mpdf->SetHeader('TourSystem'); // call methods or set any properties
		$mpdf->WriteHtml($content); // call mpdf write html
		echo $mpdf->Output('filename.pdf', 'D'); // call the mpdf api output as needed
	}
}

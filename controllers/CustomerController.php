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
use app\models\CustomerInvoice;
use app\models\Config;
use app\models\PaymentMethod;


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
		$model1->generateAuthKey();
		//$model1->authKey = "hgytdydrdrdyrdrt";
		 
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
			//$reservationForm = new ReservationForm();
			
			if (Yii::$app->request->isPost) {
				$attendees = ModelExtended::createMultiple(Attendee::classname());
				ModelExtended::loadMultiple($attendees, Yii::$app->request->post());
				// ajax validation
				if (Yii::$app->request->isAjax) {
					Yii::$app->response->format = Response::FORMAT_JSON;
					return ActiveForm::validateMultiple($attendees);
				}
					
				// validate all models
				//$valid = $reservationForm->validate();
				$valid = ModelExtended::validateMultiple($attendees);
					
				if ($valid) {
					$reservation = new Reservation();
					$reservation->reservationDate = date("Y-m-d");
					$reservation->reservationInvoiced = false;
					$reservation->customers_userId = Yii::$app->user->identity->getCustomer()->one()->customerId;
				//	if($reservationForm->userAttends === true) $count = 1;
					//else
						 $count = 0;
					foreach($attendees as $attende) $count++;
					$reservation->reservationPricePerAtendee = $count * Offer::findOne($id)->offerPrice;
					$reservation->offers_offerId = $id;
				
					$transaction = \Yii::$app->db->beginTransaction();
					try {
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
							Yii::$app->session->setFlash('reservationAdded');
						}
					} catch (Exception $e) {
						$transaction->rollBack();
						Yii::$app->session->setFlash('reservationNotAdded');
					}
				}
			}
			
			$offerName = Offer::findOne($id)->offerName;
			
			return $this->render('/reservations/reservation-form', [
					//'reservationForm' => $reservationForm,
					'offerName' => $offerName,
					'offerId' => $id,
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
	
	public function actionReservationDetail($id){
		$reservation = Reservation::findOne($id);
		return $this->render('reservation-detail', ['reservation' => $reservation]);
	}
	
	public function actionAgreement($id) {
		
		$reservation = Reservation::findOne($id);
		$config = Config::findOne(1);
	
		$content = $this->renderPartial('agreement', ['reservation' => $reservation, 'config' => $config]);
		$pdf = Yii::$app->pdf; // or new Pdf();
		$mpdf = $pdf->api; // fetches mpdf api
		$mpdf->SetHeader('TourSystem'); // call methods or set any properties
		$mpdf->WriteHtml($content); // call mpdf write html
		echo $mpdf->Output('filename.pdf', 'D'); // call the mpdf api output as needed
	}
	
	public function actionGenerateInvoice ($invoiceNo)
	{
		$invoice = CustomerInvoice::find()->where(['customerInvoiceNo' => $invoiceNo])->one();
		$conf = Config::findOne(1);
		$reservation = Reservation::find()->where(['reservationId' => $invoice->reservations_reservationId])->one();
		$payment_method = PaymentMethod::find()->where(['paymentMethodId' => $invoice->paymentMethods_paymentMethodId])->one();
		$attendees = Attendee::find()->where(['reservations_reservationId'=>$invoice->reservations_reservationId])->all();
	
		/*return $this->render('/invoices/invoice-view', array ('invoice' => $invoice,
				'reservation' => $reservation,
				'conf' => $conf,
				'payment_method' => $payment_method,
				'attendees' => $attendees));*/
		
		$content = $this->renderPartial('/invoices/invoice-view', array ('invoice' => $invoice,
				'reservation' => $reservation,
				'conf' => $conf,
				'payment_method' => $payment_method,
				'attendees' => $attendees));
		$pdf = Yii::$app->pdf; // or new Pdf();
		$mpdf = $pdf->api; // fetches mpdf api
		$mpdf->SetHeader('TourSystem'); // call methods or set any properties
		//$css = file_get_contents(Yii::$app->basePath . "/vendor/bower/bootstrap/dist/css/bootstrap.min.css");
		//$mpdf->WriteHtml($css, 1);
		$mpdf->WriteHtml($content); // call mpdf write html
		echo $mpdf->Output('invoice.pdf', 'D'); // call the mpdf api output as needed
	}
}

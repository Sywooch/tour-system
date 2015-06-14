<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Agent;
use app\models\Payment;
use app\models\Reservation;
use app\models\CustomerInvoice;
use app\models\Config;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use kartik\mpdf\Pdf;
use yii\base\Object;
use app\models\PaymentMethod;
use app\models\Attendee;
use app\models\Settlement;

class PersonnelController extends Controller
{
	public $layout = 'AdminPanel';

	public function actionAdd()
	{
		$model1 = new User ();
		$model2 = new Agent();
		
		$model1->groups_groupId=1;
		
		$model1->authKey = "aefgkjsjndjbndjvndj";
		//$model1->generateAuthKey();
		 
		if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model1);
			return ActiveForm::validate($model2);
		}
		 
		if (($model1->load(Yii::$app->request->post()) && $model1->save()) && ($model2->load(Yii::$app->request->post()) && $model2->save())) {
			$model2->user_userId=$model1->getId();
			$model1->setPassword($model1->userPassword);
			$model1->save(); $model2->save();
			Yii::$app->session->setFlash('personnelAdded');
			return $this->refresh();
		} else {
			return $this->render('personnel-form', array ('model1' => $model1, 'model2' => $model2));
		}
	}
	
	public function actionReservationsList ($id=NULL) {
		if ($id==NULL)
		$query1 = Reservation::find();
		else 
			$query1 = Reservation::find()->where(['offers_offerIs' => $id])->all();
	
		$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query1->count(),
		]);
	
		$reservations = $query1->orderBy('ReservationId')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
	
		return $this->render('reservations-list', [
				'reservations' => $reservations,
				'pagination' => $pagination,
		]);
	}
	
	/*public function actionReservationsList ($id) {
		$query1 = Reservation::find()->where(['offers_offerIs' => $id])->all();
	
		$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query1->count(),
		]);
	
		$reservations = $query1->orderBy('ReservationId')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
	
		return $this->render('reservations-list', [
				'reservations' => $reservations,
				'pagination' => $pagination,
		]);
	}*/
	
	public function actionReport() {
		
		$content = $this->renderPartial('render-form');
		$pdf = Yii::$app->pdf; // or new Pdf();
		$mpdf = $pdf->api; // fetches mpdf api
		$mpdf->SetHeader('TourSystem'); // call methods or set any properties
		$mpdf->WriteHtml($content); // call mpdf write html
		echo $mpdf->Output('filename.pdf', 'D'); // call the mpdf api output as needed
	}
	
	public function actionAddpayement($id) {
	
		$payment = new Payment();
		$payment->reservations_reservationId=$id;
	
		if ($payment->load(Yii::$app->request->post()) && $payment->save()) {
			Yii::$app->session->setFlash('paymentAdded');
			return $this->refresh();
		} else {
			return $this->render('add-payment', [
					'payment' => $payment,
			]);
		}
	
	
	}
	
	public function actionAddinvoice ($id) 
	{
		$reservation = Reservation::find()->where(['reservationId' => $id])->one();
		$invoice = new CustomerInvoice();
		$conf = Config::findOne(1);
		
		if (!$invoice->load(Yii::$app->request->post())) {
			$invoice->customerInvoiceNo = $conf->lastInvoiceNo + 1 . '/' . date('Y');
			$invoice->customerInvoiceDate = date ('Y-m-d');
			$invoice->customerInvoiceDateOfSale = date($reservation->reservationDate);
		}
		
		if (Yii::$app->request->isAjax && $invoice->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($invoice);
		}
		$invoice->reservations_reservationId = $reservation->reservationId;
		if (($invoice->load(Yii::$app->request->post()) && $invoice->save())) {
			Yii::$app->session->setFlash('invoiceAdded');
			$conf->lastInvoiceNo = (int) $conf->lastInvoiceNo+1;
			$conf->save(false);
			$reservation->reservationInvoiced = 1;
			$reservation->save(false);
			return $this->refresh();
		} else {
			return $this->render('/invoices/invoice-form', array ('invoice' => $invoice, 'reservation' => $reservation));
		}
	}
	
	public function addPayment(){
		$payment = new Payment();	
		$payment->reservations_reservationId=$id;
		
		if ($payment->load(Yii::$app->request->post()) && $payment->save()) {
			Yii::$app->session->setFlash('paymentAdded');
			return $this->refresh();
		} else {
			return $this->render('add-payment', [
					'payment' => $payment,
			]);
		}
	}
	
	public function actionGenerateInvoice ($invoiceNo)
	{
		$invoice = CustomerInvoice::find()->where(['customerInvoiceNo' => $invoiceNo])->one();
		$conf = Config::findOne(1);
		$reservation = Reservation::find()->where(['reservationId' => $invoice->reservations_reservationId])->one();
		$payment_method = PaymentMethod::find()->where(['paymentMethodId' => $invoice->paymentMethods_paymentMethodId])->one();
		$settlement = Settlement::find()->where(['offers_offerId'=>$reservation->offers_offerId])->one();

		$content = $this->renderPartial('/invoices/invoice-copy', array ('invoice' => $invoice,
				'reservation' => $reservation,
				'conf' => $conf,
				'payment_method' => $payment_method,
				'settlement' => $settlement));
		$pdf = Yii::$app->pdf; // or new Pdf();
		$mpdf = $pdf->api; // fetches mpdf api
		$mpdf->SetHeader('TourSystem'); // call methods or set any properties
		//$css = file_get_contents(Yii::$app->basePath . "/vendor/bower/bootstrap/dist/css/bootstrap.min.css");
		//$mpdf->WriteHtml($css, 1);
		$mpdf->WriteHtml($content); // call mpdf write html
		echo $mpdf->Output('invoice_COPY.pdf', 'D'); // call the mpdf api output as needed
	}
}

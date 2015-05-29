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
use app\models\app\models;



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
			$model1 = new Reservation ();
			$model2 = [new Attendee()];
			$model3 = new ReservationForm();
			
			/*if ($model1->load(Yii::$app->request->post())) {
							
			$model2 = Modelforattendees::createMultiple(Attendee::classname());
            Model::loadMultiple($model2, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple($model2);
            }
////////////////

            $model1->reservationDate=date('Y-m-d');
            $model1->offers_offerId = $id;
            $offer = Offer::findOne($id);
            $model1->reservationPricePerAtendee = $offer->offerPrice;
            $model1->customers_userId=Yii::$app->User->identity->getCustomer()->one()->customerId;//powinno być customerId
            
            $valid = $model1->validate();
            $valid = Modelforattendees::validateMultiple($model2) && $valid;
           
            if ($valid) {
            	$transaction = \Yii::$app->db->beginTransaction();
            	try {
            		if ($flag = $model1->save(false)) {
            			foreach ($model2 as $models2) {
            				$models2->reservations_reservationId = $model1->reservationId;
            				if (! ($flag = $models2->save(false))) {
            					$transaction->rollBack();
            					break;
            				}
            			}
            		}
            		if ($flag) {
            			$transaction->commit();
            			return $this->refresh();
            		}
            	} catch (Exception $e) {
            		$transaction->rollBack();
            	}
            }
        }
             return $this->render('/reservations/reservation-form', [
            		'model1' => $model1,
            		'model2' => (empty($model2)) ? [new Attendee()] : $model2,
             		//'model3' => (empty($model3)) ? [new ReservationForm()] : $model3
            ]);
            }
            //////////////*/			
			if ( $model3->load(Yii::$app->request->post())) 
			{
				//$reservation = findOne()->where(['offers_offerId' => $id])
				
				$model1->reservationDate=date('Y-m-d');
				$model1->offers_offerId = $id;
				$offer = Offer::findOne($id);
				$model1->reservationPricePerAtendee = $offer->offerPrice*$model3->attendeeQuantity;
				$model1->customers_userId=Yii::$app->User->identity->getCustomer()->one()->customerId;
				
            //$valid = Modelforattendees::validateMultiple($model2);
           // if ($valid) {
				$flag = $model1->save(false);
                $transaction = \Yii::$app->db->beginTransaction();
                
                try {
                    if ($flag) {
                        foreach ($model2 as $models2) {
                        	$models2->reservations_reservationId=$model1->reservationId;
                            if (! ($flag = $models2->save(false))) {
                                $transaction->rollBack();
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
            //   }
            }
				
				
				return $this->refresh();
			} else {
				return $this->render('/reservations/reservation-form', array ('model2' => (empty($model2)) ? [new Attendee()] : $model2, 'model3' => $model3));
			}
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

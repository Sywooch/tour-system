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
use app\models\Review;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use app\models\app\models;

class ReviewController extends Controller
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
	
	public function actionView () 
	{
		$query = Review::find();
		
		$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query->count(),
		]);
		
		$reviews = $query->orderBy('ReviewId')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		
		return $this->render('/reviews/reviews-view' , ['reviews' => $reviews, 'pagination' => $pagination,]);
	}	
}

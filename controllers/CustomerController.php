<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Users;
use app\models\Customer;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class CustomerController extends Controller
{
	public $layout = 'AdminPanel';

	public function actionAdd()
	{
		$model1 = new Users ();
		$model2 = new Customer();
		 
		if (Yii::$app->request->isAjax && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$a=$model1->validate();
			return $model2->validate() && $a;
			
		}
		 
		if ($model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post()) && $model1->save() && $model2->save()) {
			Yii::$app->session->setFlash('customerAdded');
			return $this->refresh();
		} else {
			return $this->render('customer-form', array ('model1' => $model1, 'model2' => $model2));
		}
	}
	
	public function actionBuy()
	{
		
	}

	/*public function actionList(){
		$query = Contractor::find();

		$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query->count(),
		]);

		$contractors = $query->orderBy('ContractorId')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();

		return $this->render('contractors-list', [
				'contractors' => $contractors,
				'pagination' => $pagination,
		]);
	}*/
}
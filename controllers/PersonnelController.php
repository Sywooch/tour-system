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
use kartik\mpdf\Pdf;

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
	public function actionReport() {
		
		$content = $this->renderPartial('render-form');
		$pdf = Yii::$app->pdf; // or new Pdf();
		$mpdf = $pdf->api; // fetches mpdf api
		$mpdf->SetHeader('TourSystem'); // call methods or set any properties
		$mpdf->WriteHtml($content); // call mpdf write html
		echo $mpdf->Output('filename.pdf', 'D'); // call the mpdf api output as needed
	}
}
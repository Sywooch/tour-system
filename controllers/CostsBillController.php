<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\CostsBill;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class CostsBillController extends Controller
{
	public $layout = 'AdminPanel';
	
	public function actionAdd()
    {
    	if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isPersonnel ()) {
    		$model = new CostsBill();
    	
    		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
    			Yii::$app->response->format = Response::FORMAT_JSON;
    			return ActiveForm::validate($model);
    		}
    	
    		if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
        		Yii::$app->session->setFlash('costsBillAdded');

            	return $this->refresh();
        	} else {
        		return $this->render('costsbill-form', ['model' => $model]);
    		}
    	} else {
    		Yii::$app->session->setFlash('costsBillAddAttempt');
    		return $this->render('costsbill-error');
    	}
    }
    
    public function actionList(){
    	$query = CostsBill::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $costsBills = $query->orderBy('costsBillDate')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('costsbill-list', [
            'costsBills' => $costsBills,
            'pagination' => $pagination,
        ]);
	}
	
	public function actionEdit($id){
		
			if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isPersonnel ()) {
			$model = CostsBill::findOne($id);
		
			if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($model);
			}
		
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->session->setFlash('costsBillEdited');
		
				return $this->refresh();
			} else {
				return $this->render('costsbill-form', ['model' => $model]);
			}
		} else {
			Yii::$app->session->setFlash('costsBillEditAttempt');
			return $this->render('costsbill-error');
		}
	}
	
	public function actionDelete($id){
		$model = CostsBill::findOne($id);
			
		return $this->render('costsbill-delete', ['model' => $model]);
	}
	
	public function actionConfirmDelete($id){
		CostsBill::findOne($id)->delete();
		Yii::$app->session->setFlash('costsBillDeleted');
		$model = new CostsBill();
		return $this->render('costsbill-delete', ['model' => $model]);
	}
}
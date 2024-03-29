<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Contractor;
use yii\data\Pagination;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class ContractorController extends Controller
{
	public $layout = 'AdminPanel';
	
	public function actionAdd()
    {
    	if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isPersonnel ()) {
    		$model = new Contractor();
    	
    		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
    			Yii::$app->response->format = Response::FORMAT_JSON;
    			return ActiveForm::validate($model);
    		}
    	
    		if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
        		Yii::$app->session->setFlash('contractorAdded');

            	return $this->refresh();
        	} else {
        		return $this->render('contractor-form', ['model' => $model]);
    		}
    	} else {
    		Yii::$app->session->setFlash('contractorAddAttempt');
    		return $this->render('contractor-error');
    	}
    }
    
    public function actionList(){
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
	}
	
	public function actionEdit($id){
		
			if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isPersonnel ()) {
			$model = Contractor::findOne($id);
		
			if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($model);
			}
		
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->session->setFlash('contractorEdited');
		
				return $this->refresh();
			} else {
				return $this->render('contractor-form', ['model' => $model]);
			}
		} else {
			Yii::$app->session->setFlash('contractorEditAttempt');
			return $this->render('contractor-error');
		}
	}
	
	public function actionDelete($id){
		$model = Contractor::findOne($id);
			
		return $this->render('contractor-delete', ['model' => $model]);
	}
	
	public function actionConfirmDelete($id){
		Contractor::findOne($id)->delete();
		Yii::$app->session->setFlash('contractorDeleted');
		$model = new Contractor();
		return $this->render('contractor-delete', ['model' => $model]);
	}
}
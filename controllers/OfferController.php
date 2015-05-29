<?php

namespace app\controllers;

use app\models\Offerimage;
use Yii;
use app\models\Offer;
use app\models\OfferSearch;
use app\models\Review;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\base\Object;
use app\models\Reservation;

/**
 * OfferController implements the CRUD actions for Offer model.
 */
class OfferController extends Controller
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
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Offer models.
     * @return mixed
     */
    public function actionList()
    {    	
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLastMinute ()
    {
    	$searchModel = new OfferSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	return $this->render('list', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }
    
    /**
     * Displays a single Offer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Creates a new Offer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new Offer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->offerId]);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }
    
    public function review_exists ($id) 
    {
    	$reviews = Review::find()->all();
    	
    	foreach ($reviews as $review)
    	{
    		if ($review->reservations_reservationId==$id)
    			return true;
    	}
    	return false;
    }
    
    public function actionReview ($id)
    {
    	$model = new Review();
    	if(!$model->load(Yii::$app->request->post())){
    		$model->reservations_reservationId=$id;
    		$model->reviewDate=date('Y-m-d');
    	//$model->reviewDescription="chujjjj";
    		$offer = $model->getReservationsReservation()->one()->getOffers()->one();
    		$d1=new \DateTime($model->reviewDate);
    		$d2=new \DateTime($offer->offerEndDate);
    		if ($d2>$d1)
    		{
    			Yii::$app->session->setFlash('OfferNotEnd');
    			//return $this->render('/reviews/review-form', ['model' => $model]);
    		} else {
    			if ($this->review_exists($id)){
	    			Yii::$app->session->setFlash('reviewExists');
	    			//return $this->render('/reviews/review-form', ['model' => $model]);
    			}	
    		}
    		return $this->render('/reviews/review-form', ['model' => $model]);
    	}else{
    		echo "id". $model->reservations_reservationId;
    	
    		/*	if (Yii::$app->request->isAjax) {
    				Yii::$app->response->format = Response::FORMAT_JSON;
    				return ActiveForm::validate($model);
    			}
    		
    			if ($model->save()){
    				Yii::$app->session->setFlash('reviewAdded');
    				return $this->refresh();
    			} else {
    				
    			}*/
    	}
    }

    public function actionAddimage($id)
    {
        $model_offer = new Offer();
        $model_offer_image = new Offerimage();

        if ($model_offer_image->load(Yii::$app->request->post())) {
            $model_offer_image->offers_offerId = $id;
            $model_offer_image->image_file = UploadedFile::getInstance($model_offer_image, 'image_file');
            $model_offer_image->image_file->saveAs('uploads/' . $model_offer_image->image_file->baseName . '.' . $model_offer_image->image_file->extension);
            $model_offer_image->image_path = 'uploads/' . $model_offer_image->image_file->baseName . '.' . $model_offer_image->image_file->extension;
            $model_offer_image->save();
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('addimage', [
                'model' => $model_offer_image,
            ]);
        }
    }

    /**
     * Updates an existing Offer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->offerId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Offer model.
     * If deletion is successful, the browser will be redirected to the 'list' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['list']);
    }
   

    /**
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

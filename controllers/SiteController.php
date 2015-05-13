<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            //return $this->goHome();
        if (Yii::$app->user->identity->isPersonnel()) {
        		return $this->redirect(['admin-panel/index']);
            } else {
            	return $this->redirect(['starting-panel/index']);
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            if (Yii::$app->user->identity->isPersonnel()) {
        		return $this->redirect(['admin-panel/index']);
            } else {
            	if (Yii::$app->user->identity->isCustomer()) {
            		return $this->redirect(['starting-panel/index']);
            	} else {
            		return $this->redirect(['agent-panel/index']);
            	}
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->redirect(['starting-panel/index']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}

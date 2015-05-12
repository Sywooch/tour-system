<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class StartingPanelController extends Controller
{
	public $layout = 'StartingPanel';
	
	public function actionIndex()
    {
        return $this->render('index');
    }
}
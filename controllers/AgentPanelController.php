<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class AgentPanelController extends Controller
{
	public $layout = 'AgentPanel';

	public function actionIndex()
	{
		return $this->render('index');
	}
}
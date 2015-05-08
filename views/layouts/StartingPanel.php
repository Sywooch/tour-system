<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'TourSystem',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                   ['label' => 'Oferty',
                	 'items' => [
                	 	['label' => 'Lista ofert', 'url' => ['/offer/list']],	
            		 ],
            		],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Logowanie', 'url' => ['/site/login']] :
                        ['label' => 'Wyloguj (' . Yii::$app->user->identity->userLogin . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                		Yii::$app->user->isGuest ?
                		['label' => 'Zarejestruj się', 'url' => ['/customer/add']] : ['label'=>''],
                		!Yii::$app->user->isGuest && Yii::$app->user->identity->isPersonnel() ?
                		['label' => 'Panel administrotora', 'url' => ['/admin-panel/index']] : ['label'=>'']
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
            	'homeLink' => [
            			'label' =>'Strona startowa',
            			'url' => '/starting-panel',
            	],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; TourSystem <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

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
        if (!Yii::$app->user->isGuest)  //===============================użytkownik zalogowany
        {
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
                		['label' => 'Opinie', 'url' => ['/review/view']],
                   ['label' => 'Oferty',
                	 'items' => [
                	 	['label' => 'Lista ofert', 'url' => ['/offer/list']],
                	 	Yii::$app->user->identity->isCustomer() ?
                	 		['label' => 'Moje rezerwacje', 'url' => ['/customer/reservations']] :['label'=>''],
                	 	Yii::$app->user->identity->isAgent() ?
                	 		['label' => 'Sprzedane oferty', 'url' => ['/agent/oferty']]:['label' =>''],
            		 ],
            		],
                		Yii::$app->user->identity->isPersonnel() ?
                		['label' => 'Panel administrotora', 'url' => ['/admin-panel/index']] : ['label'=>''],
                        ['label' => 'Witaj (' . Yii::$app->user->identity->userLogin . ')',
                        		'items' => [
                        				['label' => 'Edytuj dane', 'url' => ['/customer/edit', 'id' => Yii::$app->user->identity->userId]],
                        				['label' => 'Wyloguj', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]		
                        		]
                        ]                		
                ],
            ]);
            NavBar::end();
        } else { //====================================================gość
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
        					['label' => 'Opinie', 'url' => ['/review/view']],
        					['label' => 'Lista ofert', 'url' => ['/offer/list']],
        					['label' => 'Last Minute', 'url' => ['/offer/last-minute']],
        					['label' => 'Zaloguj' ,	'url' => ['/site/login']],
        					['label' => 'Rejestracja', 'url' => ['/customer/add']]
        			],
        	]);
        	NavBar::end();
        }
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

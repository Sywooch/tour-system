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
                	['label' => 'Strona startowa', 'url' => ['/starting-panel/index']],
                	['label' => 'Oferty',
                	 'items' => [
                	 	['label' => 'Dodaj ofertę', 'url' => ['/offer/add']],
                	 	['label' => 'Lista ofert', 'url' => ['/offer/list']],	
            		 ],
            		],
                    ['label' => 'Dokumenty kosztowe',
                     'items' => [
                     	['label' => 'Dodaj kontrahenta', 'url' => ['/contractor/add']], 
                     	['label' => 'Lista kontrahentów', 'url' => ['/contractor/list']],
                     	['label' => 'Dodaj dokument kosztowy', 'url' => ['/costs-bill/add']],
                     	['label' => 'Lista dokumentów kosztowych', 'url' => ['/costs-bill/list']],
                     ],	
                	],
                	['label' => 'Rezerwacje', 'url'=>['/personnel/reservation-list']],
                	['label' => 'Nowy',
                	 'items' => [
                	 	['label' => 'Nowy klient', 'url' => ['/customer/add']],
                	 	['label' => 'Nowy agent', 'url' => ['agent/add']],
                	 	['label' => 'Nowy pracownik', 'url' => ['personnel/add']],
                	],
                	],
                	Yii::$app->user->isGuest ?
                	['label' => 'Logowanie', 'url' => ['/site/login']] :
                	['label' => 'Wyloguj (' . Yii::$app->user->identity->userLogin . ')',
                			'url' => ['/site/logout'],
                			'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
            	'homeLink' => [
            			'label' =>'Panel administracyjny',
            			'url' => '/admin-panel',
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

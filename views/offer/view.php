<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\widgets\DetailView;
use yii\jui\Accordion;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = $model->offerName;
$this->params['breadcrumbs'][] = ['label' => 'Lista ofert', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-view">
    <div class='col-sm-12 text-center'>
	<?php 
    $fotorama = \metalguardian\fotorama\Fotorama::begin(
        [
            'options' => [
                'loop' => true,
                'hash' => true,
                'nav' => 'thumbs',
            	'width' => '100%',
            	'maxheight' => 550,
            ],
            'spinner' => [
                'lines' => 20,
            ],
            'tagName' => 'span',
            'useHtmlData' => false,
            'htmlOptions' => [
                'class' => 'custom-class',
                'id' => 'custom-id',
            ],
        ]
    );
	
    foreach($model->getImages()->all() as $image){
    	echo '<img src="' . $image->image_path . '">';
    }
    
    $fotorama->end(); 
    ?>
    </div>
     <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
    <div class="btn-group text-center" role="group">
    <?php 
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isPersonnel()) {
    
    	echo Html::a('Aktualizuj', ['update', 'id' => $model->offerId], ['class' => 'btn btn-primary', 'role' => 'button']);
        echo Html::a('Dodaj zdjęcie', ['addimage', 'id' => $model->offerId], ['class' => 'btn btn-primary', 'role' => 'button']);
    }
  
        if (Yii::$app->user->isGuest) {
        	echo Html::a('Rezerwacja', ['/site/login'], ['class' => 'btn btn-primary']);
        } else {
        	if (Yii::$app->user->identity->isAgent() || Yii::$app->user->identity->isPersonnel()) {
        		echo Html::a('Sprzedarz', ['/agent/sell', 'id' => $model->offerId], ['class' => 'btn btn-primary']);
        	} else {
        			echo Html::a('Rezerwacja', ['/customer/buy', 'id' => $model->offerId], ['class' => 'btn btn-primary']);
        	}
        }
        ?>
     </div>
     <br><br>
	<div class="row">
		<div class="col-xs-6 col-lg-3 text-center"><strong>Jedziemy do: </strong><br><?= $model->getCountriesCountry()->one()->countryName ?></div>
		<div class="col-xs-6 col-lg-3 text-center"><strong>Data wyjazdu: </strong><br><?= $model->offerStartDate ?></div>
		<div class="col-xs-6 col-lg-3 text-center"><strong>Data powrotu: </strong><br><?= $model->offerEndDate ?></div>
		<div class="col-xs-6 col-lg-3 lead"><strong class="pull-right">Cena: 
		<?php 
			if($model->offerIsFirstMinute != 1 && $model->offerIsLastMinute != 1) echo $model->offerPrice . " zł";
			else{
				echo '<s>' . $model->offerPrice . ' zł' . '</s><br><span class="pull-right" style="color: green">';
				if($model->offerIsFirstMinute) echo $model->offerFirstMinutePrice . " zł";
				else echo $model->offerLastMinutePrice . " zł";
				echo '</span>';
			}
		?></strong></div>
	</div>
    <br><br>
    <?= Tabs::widget([
            'items' => [
                [
                    'label' => 'Opis oferty',
                    'content' => $model->offerDescription,
                    'active' => true
                ],
                [
                    'label' => 'Miejsce zakwaterowania',
                    'content' => $model->offerAccommodation,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-accomodation'],
                ],
                [
                    'label' => 'Cena zawiera',
                    'content' => $model->offerBenefits,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-benefits'],
                ],
                [
                    'label' => 'Program pobytu',
                    'content' => $model->offerProgram,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-program'],
                ],
                [
                    'label' => 'Program fakultatywny',
                    'content' => $model->offerOptional,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-optiona'],
                ],
                [
                    'label' => 'Uwagi',
                    'content' => $model->offerNote,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-note'],
                ],
                [
                    'label' => 'Informacje praktyczne',
                    'content' => $model->offerPracticalData,
                    'headerOptions' => [],
                    'options' => ['id' => 'offer-practical-data'],
                ],
            ],
    		'options' => ['class' => 'hidden-sm hidden-xs'],
        ]);
    ?>
    <?= Accordion::widget([
    		'items' => [
    				[
    					'header' => 'Miejsce zakwaterowania',
    					'content' => $model->offerAccommodation,
    				],
    				[
    					'header' => 'Cena zawiera',
    					'content' => $model->offerBenefits,
    				],
    				[
    					'header' => 'Program pobytu',
    					'content' => $model->offerProgram,
    				],
    				[
    					'header' => 'Program fakultatywny',
    					'content' => $model->offerOptional,
    				],
    				[
    					'header' => 'Uwagi',
    					'content' => $model->offerNote,
    				],
    				[
    					'header' => 'Informacje praktyczne',
    					'content' => $model->offerPracticalData,
    				],
    		],
    		'options' => ['tag' => 'div', 'class' => 'hidden-lg hidden-md'],
    		'itemOptions' => ['tag' => 'div'],
    		'headerOptions' => ['tag' => 'h3'],
    		'clientOptions' => ['collapsible' => false, 'heightStyle' => 'content'],
    ]) ?>
</div>

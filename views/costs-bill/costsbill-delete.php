<?php
use yii\helpers\Html;

if(Yii::$app->session->hasFlash('costsBillDeleted')) $this->title = 'Dokument kosztowy usunięty.'; 
else $this->title = 'Usuwanie dokumentu kosztowego';
$this->params['breadcrumbs'][] = ['label' => 'Dokumenty kosztowe', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('costsBillDeleted')): ?>

    <div class="alert alert-success">
        Usuwanie dokumetnu kosztowego zakończone sukcesem.
    </div>
	<?php else: ?>
    <div class="alert alert-danger">
        <p>Czy jesteś pewien, że chcesz usunąć dokument kosztowy o poniższych danych:</p>
        <ul>
	        <li>Nazwa skrócona kontrahenta: <b><?= $model->getContractor()->one()->contractorShortName; ?></b></li>
	        <li>Data wystawienia: <b><?= $model->costsBillDate ?></b></li>
	        <li>Numer dokumentu: <b><?= $model->costsBillNo ?></b></li>
	        <li>Opis zdarzenia: <b><?= $model->costsBillDescription ?></b></li>
	        <li>Wartość brutto: <b><?= $model->costsBillValue ?></b></li>
	        <li>Dotyczy oferty: <b><?= $model->getSettlement()->one()->getOffer()->one()->offerName ?></b></li>
        </ul>
        <span>&nbsp;</span>
        <div class="col-lg-12">
        <div class="col-lg-6">
        <?= Html::a('<span class="glyphicon glyphicon-ok">&nbsp;Tak</span>', 'confirm-delete?id=' . $model->costsBillId,
        		['title' => 'Usuń dokument', 'class' => 'btn btn-success']) ?>
        </div>
        <div class="col-lg-6"><div class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-remove">&nbsp;Nie</span>', 'list',
        		['title' => 'Wróć do listy', 'class' => 'btn btn-danger']) ?>
        </div></div>
        </div>
        <p>&nbsp;</p>		
    </div>
    <?php endif; ?>
</div>

<?php
use yii\helpers\Html;

if(Yii::$app->session->hasFlash('contractorDeleted')) $this->title = 'Kontrahent usunięty.'; 
else $this->title = 'Usuwanie kontrahenta: ' . $model->contractorShortName;
$this->params['breadcrumbs'][] = ['label' => 'Kontrahenci', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contractorDeleted')): ?>

    <div class="alert alert-success">
        Usuwanie kontrahenta zakończone sukcesem.
    </div>
	<?php else: ?>
    <div class="alert alert-danger">
        <p>Czy jesteś pewien, że chcesz usunąć kontrahenta o poniższych danych:</p>
        <ul>
	        <li>Nazwa skrócona: <b><?= $model->contractorShortName; ?></b></li>
	        <li>Nazwa pełna: <b><?= $model->contractorFullName; ?></b></li>
	        <li>Adres: <b><?= $model->contractorStreet; ?></b></li>
	        <li>Kod pocztowy, miejscowość: <b><?= $model->contractorPostcode; ?>, <?= $model->contractorCity; ?></b></li>
	        <li>Numer NIP: <b><?= $model->contractorNIP; ?></b></li>
	        <li>Numer NIP: <b><?= $model->contractorNIP; ?></b></li>
        </ul>
        <span>&nbsp;</span>
        <div class="col-lg-12">
        <div class="col-lg-6">
        <?= Html::a('<span class="glyphicon glyphicon-ok">&nbsp;Tak</span>', 'confirm-delete?id=' . $model->contractorId,
        		['title' => 'Usuń kontrahenta', 'class' => 'btn btn-success']) ?>
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

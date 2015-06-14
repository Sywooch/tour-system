<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Witaj w Tour-System</h1>

        <p class="lead">Zaloguj się w celu złożenia rezerwacji.</p>

       
    </div>

    <div class="body-content">

        <div class="row">
        <?php 
        foreach($offers as $offer){
        	$row =<<<ROW
        	<div class="col-lg-4">
				<div>
					<img src="{$offer->getImages()->one()->image_path}" class="img-responsive img-thumbnail">
				</div>
                <h2><a href="/offer/view?id={$offer->offerId}"> {$offer->offerName}</a></h2>

                <p>{$offer->offerDescription}</p>

            </div>
        	
ROW;
        	echo $row;
        }
        ?>
        </div>

    </div>
</div>

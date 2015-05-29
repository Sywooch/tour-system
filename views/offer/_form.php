<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Country;
use app\models\Season;
use dosamigos\datepicker\DatePicker;
use dosamigos\switchinput;
use dosamigos\tinymce\TinyMce;
use dosamigos\switchinput\SwitchBox;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'offerName')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'offerStartDate')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
    ]);?>

    <?= $form->field($model, 'offerEndDate')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
    ]);?>

    <?= $form->field($model, 'offerPrice')->textInput() ?>

    <?= $form->field($model, 'offerDescription')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>

    <?= $form->field($model, 'offerAccommodation')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>

    <?= $form->field($model, 'offerBenefits')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>

    <?= $form->field($model, 'offerProgram')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>

    <?= $form->field($model, 'offerOptional')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>

    <?= $form->field($model, 'offerNote')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>

    <?= $form->field($model, 'offerPracticalData')->widget(TinyMce::classname(), [
    	'options' => ['rows' => 10],
    	'language' => 'pl',
    	'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>

    <?= $form->field($model, 'offerLastMinutePrice')->textInput() ?>

    <?= $form->field($model, 'offerFirstMinutePrice')->textInput() ?>

    <?= $form->field($model, 'offerIsFirstMinute')->widget(
    		SwitchBox::className(), [
    			'clientOptions' => [
    				'onText' => 'TAK',
    				'offText' => 'NIE'
    			]
    ]
    )->label(false) ?>

    <?= $form->field($model, 'offerIsLastMinute')->widget(
    		SwitchBox::className(), [
    			'clientOptions' => [
    				'onText' => 'TAK',
    				'offText' => 'NIE'
    			]
    ])->label(false); ?>

    <?= $form->field($model, 'offerIsActive')->widget(
    		SwitchBox::className(), [
    			'clientOptions' => [
    				'onText' => 'TAK',
    				'offText' => 'NIE'
    			]
    ])->label(false) ?>

    <?= $form->field($model, 'countries_countryId')->dropDownList(
        ArrayHelper::map(Country::find()->all(),'countryId','countryName'),
        ['prompt' => 'Select Country']
    ) ?>

    <?= $form->field($model, 'seasons_seasonId')->dropDownList(
        ArrayHelper::map(Season::find()->all(),'seasonId','seasonName'),
        ['prompt' => 'Select Season']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
